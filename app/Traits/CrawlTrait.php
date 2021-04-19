<?php

namespace App\Traits;
use Exception;
use Str;

trait CrawlTrait
{
    public function getHtml($node, $path)
    {
        try {
            return $node->filter($path)->first()->html();
        } catch (Exception $e) {
            return null;
        }
    }

    public function getText($node, $path)
    {
        try {
            return $node->filter($path)->text();
        } catch (Exception $e) {
            return null;
        }
    }

    public function getAttr($node, $path, $attr)
    {
        try {
            return $node->filter($path)->attr($attr);
        } catch (Exception $e) {
            return null;
        }
    }

    public function getCurrentAttr($node, $attr)
    {
        try {
            return $node->attr($attr);
        } catch (Exception $e) {
            return null;
        }
    }

    public function mixUrl($link)
    {
        return Str::startsWith($link, 'https://') ? $link : $this->baseUrl . '' . $link;
    }
}
