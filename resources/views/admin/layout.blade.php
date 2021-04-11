
<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="backend/vendor/bootstrap/css/bootstrap.min.css">
    <link href="backend/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="backend/libs/css/style.css">
    <link rel="stylesheet" href="backend/libs/css/custom.css">
    <link rel="stylesheet" href="backend/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="backend/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="backend/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="backend/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="backend/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="backend/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <title>News | Admin</title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        @include('admin.includes.header')
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        @include('admin.includes.sidebar')
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                @yield('admin_content')
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            @include('admin.includes.footer')
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="backend/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="backend/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="backend/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script>
      const CK_UPLOAD_IMG = "{{route('admin.editor.upload', ['_token' => csrf_token()])}}";
    </script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script src="backend/libs/js/main-js.js"></script>
</body>
 
</html>