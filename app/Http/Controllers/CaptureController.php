<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use Str;

class CaptureController extends Controller
{
    public function index(){
      return view('capture.index');
    }

    public function store(Request $request){
      $url = $request->get('url');
      $image = Str::random(15).'.png';
      if($url){
        Browsershot::url($url)->fullPage()->save('uploads/'.$image);
        $file_path = public_path('uploads/'.$image);
        return response()->download($file_path);
      }
    }
}
