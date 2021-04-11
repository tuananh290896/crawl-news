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
use App\Models\Category;
use App\Models\News;
use Str;

class Sync24h implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, CrawlTrait;

    protected $category;
    protected $baseUrl = "https://bongda24h.vn";

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($category)
    {
        $this->category = $category;
    }

    public function getNews($connect, $path){
      $doc = $connect->getDocument($path);

      $articles = $doc->filter('.main .article-list')->each(
        function (Crawler $node){
            $img = $this->getAttr($node, '.article-image .image source.lazyload', 'data-srcset')
                    ?? 'https://cdn.bongda24h.vn/images/logo-bongda24h.svg';
            $link= $this->getAttr($node, '.article-title  a', 'href');
            $link = $this->mixUrl($link);
            $title = $this->getText($node, '.article-title  a');
            $description = $this->getText($node, '.article-summary a'); 
            return [
              "image_url" => $img,
              "link" => $link,
              "title" => $title,
              "description" => $description
            ];
        }
      );

      $news = $doc->filter('.main .post-list')->each(
        function (Crawler $node){
            $img = $this->getAttr($node, '.article-image .image source.lazyload', 'data-srcset')
                   ?? 'https://cdn.bongda24h.vn/images/logo-bongda24h.svg';
            $link= $this->getAttr($node, '.article-title  a', 'href');
            $link = $this->mixUrl($link);
            $title = $this->getText($node, '.article-title  a');
            $description = $this->getText($node, '.article-summary a'); 
            return [
              "image_url" => $img,
              "link" => $link,
              "title" => $title,
              "description" => $description
            ];
        }
      );

      return array_merge($articles, $news);
    }

    public function getNewsDetail($connect, $news){
      $doc = $connect->getDocument($news["link"]);
      $news["detail"] = $this->getHtml($doc, '.main .section .the-article-content div:last-child');
      $news["description"] = $this->getText($doc, '.main .section .the-article-content .summary strong');
      
      return $news;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $connect = new Connection();
      $category = $this->category;
      $category["slug"] = Str::slug($category["name"]);
      $news = $this->getNews($connect, $category["path"]);

      // Save category
      $cate = Category::firstOrNew(['slug' =>  $category["slug"], 'source' => $this->baseUrl]);
      $cate->name = $category["name"];
      $cate->save();

      // Craw detail news
      foreach ($news as $key => $item) {
        $list = $this->getNewsDetail($connect, $item);
        $list["slug"] = Str::slug($list["title"]);

        $source = News::firstOrCreate([
          'slug' => $list["slug"],
          'title' => $list["title"],
          'source' => $this->baseUrl,
          'category_id' => $cate->id
        ]);
        $source->update($list);

        sleep(1);
      }
    }
}
