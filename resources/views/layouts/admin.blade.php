<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<title>admin panel</title>
	<!-- Favicon-->
	<link rel="icon" href="{{ asset('lorax/assets/images/favicon.ico') }}" type="image/x-icon">
	<!-- Plugins Core Css -->
	<link href="{{ asset('lorax/assets/css/app.min.css') }}" rel="stylesheet">
	<link href="{{ asset('lorax/assets/js/bundles/materialize-rtl/materialize-rtl.min.css')}}" rel="stylesheet">
	<!-- Custom Css -->
	<link href="{{ asset('lorax/assets/css/style.css') }}" rel="stylesheet" />
	<!-- Theme style. You can choose a theme from css/themes instead of get all themes -->
	<link href="{{ asset('lorax/assets/css/styles/all-themes.css') }}" rel="stylesheet" />
	@yield('meta')
</head>
{{-- @php($user=Auth::user()) --}}
{{-- {{dd($user->roles()->get()[0]->name)}} --}}

<body class="light menu_dark theme-black logo-white submenu-closed rtl">



	<!-- Page Loader -->
	{{-- @include('admin.components.preloader') --}}
	<!-- #END# Page Loader -->
	<!-- Overlay For Sidebars -->
	<div class="overlay"></div>
	<!-- #END# Overlay For Sidebars -->
	<!-- Top Bar -->
	@component('components.admin_top_bar')
	@endcomponent
	<!-- #Top Bar -->
	<div>
		<!-- Left Sidebar -->
		@component('components.admin_right_sidebar')
		@endcomponent
		<!-- #END# Left Sidebar -->
	</div>

	<section class="content">
		<div class="container-fluid">
			@yield('content')


		</div>
	</section>


@yield('scripts')

</body>
