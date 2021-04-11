<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Scraper\Connection;
use Symfony\Component\DomCrawler\Crawler;
use App\Traits\CrawlTrait;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Models\ScheduleCategory;
use Str;

class CrawlSchedule extends Command
{
    use CrawlTrait;
    protected $baseUrl = "https://bongda24h.vn";
    protected $sourceUrl = "https://bongda24h.vn/Schedules/AjaxSchedules?date=:date&leagueId=0";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl schedule';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
          $client = new Client();
          $now = Carbon::now()->format('d-m-Y');
          $date = Carbon::now()->format('Y-m-d');
          $url = Str::replaceArray(':date', [$now], $this->sourceUrl);
          $request = $client->get($url);
          $html = $request->getBody()->getContents();
          $doc = new Crawler($html);

          // Get list from html
          $results = $doc->filter('.result-livescore .frow-cup')->each(
            function (Crawler $node) use ($date){
                $name = $node->text();
                $schedules = [];

                foreach ($node->nextAll('.frow') as $node2) {
                  $node2 = new Crawler($node2);
                  $time = $this->getHtml($node2, '.dte');
                  if(!$time) break;

                  $fname1 = $this->getText($node2, '.hme .fname1');
                  $flogo1 = $this->getAttr($node2, '.hme .flogo', 'src');
                  $fname2 = $this->getText($node2, '.awy .fname2');
                  $flogo2 = $this->getAttr($node2, '.awy .flogo', 'src');
                  $schedules[] = [
                    'time' => $time,
                    'date' => $date,
                    'fname1' => $fname1,
                    'flogo1' => $this->mixUrl($flogo1),
                    'fname2' => $fname2,
                    'flogo2' => $this->mixUrl($flogo2),
                  ];
                }

                return [
                  'name' => $name,
                  'schedules' => $schedules
                ];
            }
          );

          // Save to db
          foreach ($results as $result) {
            $slug = Str::slug($result['name']);
            $schedules = $result['schedules'];
            $category = ScheduleCategory::firstOrNew(['slug' => $slug]);
            $category->name = $result['name'];
            $category->save();

            try {
              $category->schedules()->whereDate('date', $date)->delete();
              $category->schedules()->createMany($schedules);
            } catch (\Exception $e) {
              echo $e->getMessage();
            }
          }

          echo "Cập nhật lịch thi đấu ngày $now thành công!";
        } catch (\Exception $e) {
          echo $e->getMessage();
        }
    }
}
