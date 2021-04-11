<div class="row">

  <div class="col-8">
    {!!Form::text('title', 'Tiêu đề')->placeholder('Tiêu đề')!!}
    {!!Form::textarea('description', 'Mô tả ngắn')->placeholder('Mô tả ngắn')!!}
    {!!Form::textarea('detail', 'Chi tiết')->placeholder('Chi tiết')->attrs(['class' => 'editor'])!!}
    {!!Form::text('link', 'Liên kết')->placeholder('Liên kết bài gốc')!!}
    {!!Form::text('source', 'Nguồn')->placeholder('Nguồn tin tức')!!}
    <div class="btn-groups">
      <a class="btn btn-danger btn-sm" href="{{route('admin.news')}}">Huỷ bỏ</a>
      <button class="btn btn-success btn-sm">Xác nhận</button>
    </div>
  </div>

  <div class="col-4">
    {!!Form::select('category_id', 'Danh mục tin tức', $categories)->placeholder('Danh mục')!!}

    {!!Form::file('image_url', 'Ảnh thu nhỏ')->attrs(['class' => 'input-file'])!!}
  </div>
</div>