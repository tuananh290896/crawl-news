<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Traits\CrawlTrait;
use App\Scraper\Connection;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\RankCategory;
use App\Models\Rank;
use Str;

class SyncRanking implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, CrawlTrait;

    protected $url;
    protected $baseUrl = "https://bongda24h.vn";

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    public function getRanking($connect, $path){
      $doc = $connect->getDocument($path);

      $name = $doc->filter('.box-bxh .title-giaidau')->first()->text();
      $rankings = $doc->filter('.box-bxh .table-bxh tbody tr:not(:first-child)')->each(
        function (Crawler $node){
            $rank = $this->getText($node, 'td:first-child');
            $name = $this->getText($node, '.link-clb');
            $total = $this->getText($node, 'td:nth-child(3)');
            $win = $this->getText($node, 'td:nth-child(4)');
            $equal = $this->getText($node, 'td:nth-child(5)');
            $lose = $this->getText($node, 'td:nth-child(6)');
            $difference = $this->getText($node, 'td:nth-child(7)');
            $score = $this->getText($node, 'td:nth-child(8)');

            return [
              "rank" => $rank,
              "name" => $name,
              "total" => $total,
              "win" => $win,
              "equal" => $equal,
              "lose" => $lose,
              "difference" => $difference,
              "score" => $score
            ];
        }
      );

      return [ 'name' => $name, 'rankings' => $rankings ];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $connect = new Connection();
      $link = $this->mixUrl($this->url);
      $rank = $this->getRanking($connect, $link);

      // Save category
      $cate = RankCategory::firstOrNew(['source' =>  $link]);
      $cate->name = $rank["name"];
      $cate->save();

      // Craw detail news
      $cate->rankings()->createMany($rank["rankings"]);
    }
}
