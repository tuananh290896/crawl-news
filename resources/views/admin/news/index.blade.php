@extends('admin.layout')

@section('admin_content')
    <div class="container-fluid dashboard-content ">
        <!-- ============================================================== -->
        <!-- pageheader  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Tin tức</h2>
                    <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris
                        facilisis faucibus at enim quis massa lobortis rutrum.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tin tức</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.includes.messages');
        <!-- ============================================================== -->
        <!-- end pageheader  -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- ============================================================== -->
            <!-- basic table -->
            <!-- ============================================================== -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-header-with-button">
                      <h5 class="mb-0 card-header-title">Quản lý tin tức</h5>
                      <a href="{{route('admin.news.create')}}" class="btn btn-sm btn-success">Thêm mới</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                    <tr class="border-0">
                                        <th class="border-0 no-wrap">#</th>
                                        <th class="border-0 no-wrap">Hình ảnh</th>
                                        <th class="border-0 no-wrap">Tiêu đề</th>
                                        <th class="border-0 no-wrap">Danh mục</th>
                                        <th class="border-0 no-wrap">Link gốc</th>
                                        <th class="border-0 no-wrap">Nguồn</th>
                                        <th class="border-0 no-wrap">Ngày tạo</th>
                                        <th class="border-0 no-wrap">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($news as $key => $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>
                                                <div class="m-r-10">
                                                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="rounded" width="45">
                                                </div>
                                            </td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ optional($item->category)->name }}</td>
                                            <td>
                                                <a href="{{ $item->link }}" target="_blank">Xem</a>
                                            </td>
                                            <td class="no-wrap"><span class="badge-dot badge-brand mr-1"></span> {{ $item->source }}</td>
                                            <td class="no-wrap">{{ $item->created_at }}</td>
                                            <td>
                                              <div class="btn-groups mt-0">
                                                  <a class="btn btn-info btn-xs" href="{{route('admin.news.edit', $item->id)}}">
                                                    <i class="fas fa-info-circle"></i>
                                                  </a>
                                                  <a class="btn btn-danger btn-xs delete-confirm" href="{{route('admin.news.delete', $item->id)}}">
                                                    <i class="fas fa-trash-alt"></i>
                                                  </a>
                                              </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer navigation">
                        {{ $news->onEachSide(2)->links() }}
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
        </div>
    </div>
@endsection
