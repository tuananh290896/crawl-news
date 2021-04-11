<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\Category;
use App\Models\News;
use DB;
use Str;
use  App\Traits\UploadTrait;

class NewsController extends BaseController
{
    use UploadTrait;

    public function index()
    {
        $news = News::with('category')->latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $categories = Category::all()->pluck('name', 'id');
        return view('admin.news.create', compact('categories'));
    }

    public function store(CreateNewsRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->getData();
            $image = $request->file('image_url');
            $data['image_url'] = $this->uploadImage($image, 'news');
            $data['slug'] = Str::slug($data['title']);
            $news = News::create($data);
            DB::commit();
            return redirect()->route('admin.news')->withFlashSuccess('Tạo mới tin tức thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        } //end try
    }

    public function edit($id)
    {
      $news = News::findOrFail($id);
      $categories = Category::all()->pluck('name', 'id');
      return view('admin.news.edit', compact('categories', 'news'));
    }

    public function update(UpdateNewsRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $news = News::findOrFail($id);
            $data = $request->getData();
            $data['slug'] = Str::slug($data['title']);
            if($request->hasFile('image_url')){
              $image = $request->file('image_url');
              $data['image_url'] = $this->uploadImage($image, 'news');
            }else{
              $data['image_url'] = $request->get('old_image_url');
            }
            $news->update($data);

            DB::commit();
            return redirect()->route('admin.news')->withFlashSuccess('Cập nhật tin tức thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        } //end try
    }

    public function destroy($id){
      try {
        DB::beginTransaction();
        $news = News::findOrFail($id);
        $news->delete();
        DB::commit();
        return redirect()->route('admin.news')->withFlashSuccess('Xoá tin tức thành công');
      } catch (\Exception $e) {
          DB::rollBack();
          return redirect()->back()->withErrors($e->getMessage());
      } //end try
    }
}
