<?php

namespace App\Scraper;

use Goutte\Client;

class Connection
{
    protected $client;

    public function __construct() {
      $this->client = new Client();
    }

    public function getDocument($url){
      $crawler = $this->client->request('GET', $url);
      return $crawler;
    }
}