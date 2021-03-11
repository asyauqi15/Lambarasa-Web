<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lambarasa Education @yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
  <!-- lambarasa Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/lambarasa.css') }}">

  @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light sticky-top">
  <div class="container">
    <a class="navbar-brand" href="/">
      <img src="{{ asset('img/lr-logo-long.png') }}" height="30" alt="" />
    </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars ml-1"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav text-uppercase font-weight-bold ml-auto">
        <li class="nav-item"><a class="nav-link text-dark" href="#">About</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="#">Contact</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="#">Blog</a></li>
        @if (Auth::check())
          <li class="nav-item pt-1"><a class="btn btn-sm btn-primary nav-btn" href="">DASHBOARD</a></li>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm mt-1">Keluar</button>
          </form>
        @else
          <li class="nav-item pt-1"><a class="btn btn-sm btn-primary nav-btn" href="{{ route('login') }}">MASUK</a></li>
        @endif
      </ul>
    </div>
  </div>
</nav>

@yield('content')

<footer class="py-4 bg-dark" style="font-size: 0.9rem;">
  <div class="container">
    <div class="row">
      <div class="col-md-4 py-4">
        <div class="px-4 mb-4">
          <img src="{{ asset('img/lr-logo-long-white.png') }}" class="img-fluid">
        </div>
        <div class="px-4">
          <a class="btn btn-sm btn-circle btn-primary btn-social" href=""><i class="fab fa-instagram"></i></a>
          <a class="btn btn-sm btn-circle btn-primary btn-social mx-2" href=""><i class="fab fa-facebook-f"></i></a>
          <a class="btn btn-sm btn-circle btn-primary btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>
      <div class="col-md-4 py-4 px-4">
        <h5 class="text-light">Direktori</h5>
        <a class="text-light" href="">About</a><br>
        <a class="text-light" href="">Contact</a><br>
        <a class="text-light" href="">Blog</a><br>
      </div>
      <div class="col-md-4 py-4 px-4">
        <h5 class="text-light">Hubungi Kami</h5>
        <p class="text-light">Alamat:<br>Jalan-jalan ke pasar senin. Cakep. Eh malah pantun. Sorry.</p>
        <p class="text-light">Email:<br>cs@lambarasa.com</p>
      </div>
    </div>
  </div>
</footer>
<footer class="footer py-3 bg-black">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 text-lg-left">Copyright © Lambarasa Education 2021</div>
      <div class="col-lg-6 text-lg-right">
        <a class="mr-3 text-light" href="">Privacy Policy</a>
        <a class="text-light" href="">Terms of Use</a>
      </div>
    </div>
  </div>
</footer>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.js') }}"></script>
<!-- Lambarasa Custom JS -->
<script src="{{ asset('js/lambarasa.js') }}"></script>

@stack('scripts')
</body>
</html>