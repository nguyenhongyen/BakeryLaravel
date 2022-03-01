<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
 
  <link rel="stylesheet" href="{{ asset('asset/AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/AdminLTE/dist/css/adminlte.min.css') }}">
 @yield('css')
 
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/Admin') }}" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/Admin') }}" class="brand-link">
      <p class="text-center mb-0">Admin</p>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="{{ route('Category.index') }}" class="nav-link">
              <i class="fas fa-file-alt"></i>
              <p> Quản lý danh mục</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('Product.index') }}" class="nav-link">
              <i class="fas fa-hamburger"></i>
              <p>  Quản lý sản phẩm</p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link ">
              <i class="fas fa-newspaper"></i>
              <p>
                Quản lý tin tức
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('Slider.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Quản lý slider</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('Blog.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Quản lý bài viết</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('Coupon.index') }}" class="nav-link">
              <i class="fas fa-tags"></i>
              <p> Quản lý khuyến mãi</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('Comment.index') }}" class="nav-link">
              <i class="fas fa-user-edit"></i>
              <p> Quản lý bình luận</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('Favorite.favorite_cus') }}" class="nav-link">
              <i class="fas fa-heart"></i>
              <p> Quản lý yêu thích</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('Customer.customer') }}" class="nav-link">
              <i class="fas fa-users"></i>
              <p> Quản lý thành viên</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('Order.order') }}" class="nav-link">
              <i class="fas fa-file-alt"></i>
              <p> Quản lý đơn hàng</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
         
            @yield('breadcrumb')
          
        </div>
      </div>
    </div>
    <div class="content">
     
      @yield('content')
         

    </div>
  </div>
 
</div>

<!-- CSS -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

<script src="{{ asset('asset/AdminLTE/plugins/jquery/jquery.min.js ') }}"></script>
<script src="{{ asset('asset/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js ') }}"></script>
 @yield('script')
 @yield('script2')

<script src="{{ asset('asset/AdminLTE/dist/js/adminlte.js ') }}"></script>
<script src="{{ asset('asset/AdminLTE/plugins/chart.js/Chart.min.js ') }}"></script>
<script src="{{ asset('asset/AdminLTE/dist/js/demo.js ') }}"></script>
<script src="{{ asset('asset/AdminLTE/dist/js/pages/dashboard3.js ') }}"></script>


</body>
</html>
