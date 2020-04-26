<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>وبلاگ لامینور - مدیریت</title>
    <!-- Favicon-->
    <link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
    <!-- Plugins Core Css -->
    <link href="{{asset('css/app.min.css')}}" rel="stylesheet">
    <link href="{{asset('js/bundles/materialize-rtl/materialize-rtl.min.css')}}" rel="stylesheet">
    <!-- Custom Css -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet" />
    <!-- Theme style. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{asset('css/styles/all-themes.css')}}" rel="stylesheet" />
</head>
<body class="rtl light theme-white logo-white submenu-closed ls-closed">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30">
                <img class="loading-img-spin" src="{{asset('images/loading.png')}}" width="20" height="20" alt="admin">
            </div>
            <p>لطفا صبر کنید...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    @include('layouts.topbar')
    <!-- #Top Bar -->
    <div>
        <!-- Left Sidebar -->
        @include('layouts.sidebar_left')
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        @include('layouts.sidebar_right')
        <!-- #END# Right Sidebar -->
    </div>
    <section class="content">
        <div class="container-fluid">
            @yield('main')
        </div>
    </section>
    <!-- Plugins Js -->
    <script src="{{asset('js/app.min.js')}}"></script>
    <script src="{{asset('js/chart.min.js')}}"></script>
    <!-- Custom Js -->
    <script src="{{asset('js/admin.js')}}"></script>
    <script src="{{asset('js/pages/index.js')}}"></script>
    <script src="{{asset('js/pages/charts/jquery-knob.js')}}"></script>
    <script src="{{asset('js/pages/sparkline/sparkline-data.js')}}"></script>
    <script src="{{asset('js/pages/medias/carousel.js')}}"></script>

    @yield('script')
</body>
