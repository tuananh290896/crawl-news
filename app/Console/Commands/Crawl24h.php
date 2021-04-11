<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Scraper\Connection;
use Symfony\Component\DomCrawler\Crawler;
use App\Traits\CrawlTrait;
use App\Jobs\Sync24h;

class Crawl24h extends Command
{
    use CrawlTrait;
    protected $baseUrl = "https://bongda24h.vn";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:bongda24h';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl data from bongda 24h';

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
      return $doc->filter('.main .category-grid-3 .section-header a')->each(
        function (Crawler $node){
            $link = $node->attr('href');
            $link = $this->mixUrl($link);
            return [
              "name" => $node->text(),
              "path" => $link
            ];
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
        $doc = $connect->getDocument($this->baseUrl);
        $categories = $this->getCategories($doc);
        foreach ($categories as $key => $category) {
          Sync24h::dispatch($category);
          print "Page: {$key} loaded. \n";
          sleep(1);
        }
    }
}
