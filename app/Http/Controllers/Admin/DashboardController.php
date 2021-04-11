<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class DashboardController extends BaseController
{
    public function index(){
      $news = News::with('category')->latest()->limit(6)->get();
      return view('admin.dashboard.index', compact('news'));
    }
}
