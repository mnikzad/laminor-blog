<!DOCTYPE html>
<html lang="fa_IR">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>وبلاگ لامینور</title>

	<!--Fav and touch icons-->
	<link rel="apple-touch-icon-precomposed" sizes="144x144"
		href="{{asset('startrap/img/ico/apple-touch-icon-144-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114"
		href="{{asset('startrap/img/ico/apple-touch-icon-114-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72"
		href="{{asset('startrap/img/ico/apple-touch-icon-72-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" href="{{asset('ico/apple-touch-icon-57-precomposed.html')}}">
	<link rel="shortcut icon" href="{{asset('startrap/img/ico/favicon.png')}}">

	<!--Og Tags-->
	<meta property="og:type" content="product">
	<meta property="og:image" content="thumbnail.png">

	<!--CSS-->
	<!--===============================================================-->
	<!--Bootstrap Core CSS-->
	<link href="{{asset('startrap/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
	<!--Font Awesome Icons-->
	<link href="{{asset('startrap/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
	{{-- <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet"> --}}
	<!--Slick Carousel-->
	<link href="{{asset('startrap/css/slick.css')}}" rel="stylesheet">
	<!--Animation-->
	<link href="{{asset('startrap/css/animate.css')}}" rel="stylesheet">
	<!--Custom CSS-->
	<link href="{{asset('startrap/css/style-dark.css')}}" rel="stylesheet">

	<!--HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
	<!--WARNING: Respond.js doesn't work if you view the page via file://-->
	<!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
		<![endif]-->

	@yield('meta')

</head>

<body>

	<!--PRELOADER-->
	<!--===============================================================-->
	{{-- @include('components.preloader') --}}

	<!--NAVIGATION-->
	<!--===============================================================-->
	@component('components.topbar')

    @endcomponent
	<!--/.navbar-->

	@yield('content')

	<!--FOOTER-->
	<!--===============================================================-->
	@component('components.footer')

    @endcomponent
	<!--/footer-->
	<!--back to top-->
	@include('components.backtotop')


	@yield('scripts')
	<script>
		$(document).ready(function(){
				$('#subscribe-form').submit(function(e){
						e.preventDefault();
						var form=$(this);
						var post_url= form.attr('action');
						var post_data= form.serialize();
						$.ajax({
							type: 'POST',
							url: post_url,
							data: post_data,
							success: function (response){
								console.log(response);
								if (response.success){
									$('#subscribe-form').hide();
									$('#EmailSent').removeClass('hidden');
								}
							},
							error: function(response){
								console.log(response);
								if (response.error){
									$('#subscribe-form').hide();
									$('#EmailNotSent').removeClass('hidden');
								}
							}
						});
					});
				});
	</script>

</body>

</html>
