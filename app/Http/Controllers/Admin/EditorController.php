<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditorController extends BaseController
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $type = $request->get('responseType');
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('uploads/ckeditor'), $fileName);
            $url = asset('uploads/ckeditor/'.$fileName); 
            $msg = 'Image uploaded successfully'; 

            if ($type == 'json'){
              $file = [
                "uploaded" => 1,
                "fileName" => $fileName,
                "url" => $url
              ];

              return response()->json($file);
            }

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }
}
