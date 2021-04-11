<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Scraper\Connection;
use Symfony\Component\DomCrawler\Crawler;
use App\Traits\CrawlTrait;
use App\Jobs\SyncRanking;
use App\Models\RankCategory;

class CrawlRanking extends Command
{
    use CrawlTrait;
    protected $baseUrl = "https://bongda24h.vn";
    protected $sourceUrl = "https://bongda24h.vn/bang-xep-hang.html";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:ranking';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl ranking board!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getCategories($doc){
      return $doc->filter('.section .sidebar-left .ul-sbar a')->each(
        function (Crawler $node){
            $link = $node->attr('href');
            $link = $this->mixUrl($link);
            return $link;
        }
      );
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      $connect = new Connection();
      $doc = $connect->getDocument($this->sourceUrl);
      $categories = $this->getCategories($doc);

      RankCategory::truncate();
      
      foreach ($categories as $key => $link) {
        SyncRanking::dispatch($link);
        print "Page: {$key} loaded. \n";
        sleep(1);
      }
    }
}
