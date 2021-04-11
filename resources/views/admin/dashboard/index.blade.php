@extends('admin.layout')

@section('admin_content')
    <div class="container-fluid dashboard-content ">
        <!-- ============================================================== -->
        <!-- pageheader  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Dashboard</h2>
                    <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris
                        facilisis faucibus at enim quis massa lobortis rutrum.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Home</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end pageheader  -->
        <!-- ============================================================== -->
        <div class="ecommerce-widget">

            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-muted">Số tin tức</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">100</h1>
                            </div>
                            <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                <span><i class="fa fa-fw fa-arrow-up"></i></span><span>5.86%</span>
                            </div>
                        </div>
                        <div id="sparkline-revenue"></div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-muted">Lượng truy cập</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">200</h1>
                            </div>
                            <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                <span><i class="fa fa-fw fa-arrow-up"></i></span><span>5.86%</span>
                            </div>
                        </div>
                        <div id="sparkline-revenue2"></div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-muted">Quảng cáo</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">100</h1>
                            </div>
                            <div class="metric-label d-inline-block float-right text-primary font-weight-bold">
                                <span>N/A</span>
                            </div>
                        </div>
                        <div id="sparkline-revenue3"></div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-muted">Thu nhập</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">$28000</h1>
                            </div>
                            <div class="metric-label d-inline-block float-right text-secondary font-weight-bold">
                                <span>-2.00%</span>
                            </div>
                        </div>
                        <div id="sparkline-revenue4"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- ============================================================== -->

                <!-- ============================================================== -->

                <!-- recent orders  -->
                <!-- ============================================================== -->
                <div class="col-12">
                    <div class="card">
                        <h5 class="card-header">Tin mới nhất</h5>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr class="border-0">
                                            <th class="border-0">#</th>
                                            <th class="border-0">Hình ảnh</th>
                                            <th class="border-0">Tiêu đề</th>
                                            <th class="border-0">Danh mục</th>
                                            <th class="border-0">Link gốc</th>
                                            <th class="border-0">Nguồn</th>
                                            <th class="border-0">Ngày tạo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($news as $key => $item)
                                          <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>
                                                <div class="m-r-10">
                                                  <img src="{{$item->image_url}}" alt="{{$item->title}}" class="rounded" width="45">
                                                </div>
                                            </td>
                                            <td>{{$item->title}}</td>
                                            <td>{{optional($item->category)->name}}</td>
                                            <td>
                                              <a href="{{$item->link}}" target="_blank">Xem</a>
                                            </td>
                                            <td><span class="badge-dot badge-brand mr-1"></span> {{$item->source}}</td>
                                            <td>{{$item->created_at}}</td>
                                          </tr>
                                        @endforeach
   
                                        <tr>
                                            <td colspan="9"><a href="#" class="btn btn-outline-light float-right">Xem toàn bộ</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end recent orders  -->
            </div>

        </div>
    </div>
@endsection
