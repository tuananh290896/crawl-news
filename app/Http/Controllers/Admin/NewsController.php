<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
class NewsController extends BaseController
{
  public function index(){
    $news = News::with('category')->latest()->paginate(10);
    return view('admin.news.index', compact('news'));
  }
}
