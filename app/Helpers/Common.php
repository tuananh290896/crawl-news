<?php

namespace App\Helpers;

class Common
{
  public static function activeNav($key){
    return request()->is("$key/*") || request()->is($key) 
            ? 'active'
            : '';
  }
}