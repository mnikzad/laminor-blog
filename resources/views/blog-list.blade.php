@extends('layouts.blog')

@section('content')

<!--HEADER-->
<!--===============================================================-->
@component('components/header')

@endcomponent('components.header')
<!--/.intro-header-->

<!--BLOG-->
<!--===============================================================-->
<section class="content-section-a parallax" data-stellar-background-ratio="0.5" id="blog">
	<div class="container">
		<div class="row">
			<div class="main col-sm-8">

				@foreach ($posts as $post)
				<!--/.post-box-->
				<article class="post-box list-single mb40">
					<div class="img-box">
						<a href="">
							<img src="{{$post['banner_path']}}" alt=""
								style="max-height:fill-available;max-height:-moz-available;max-height:-webkit-fill-available;object-fit:cover">
						</a>
						<span class="comment-num">
							<span>
								<i class="fas fa-comment" style="margin-left:2px"></i>
							</span>
							<span style="margin-left:7px">
								{{$post['views']}}
								<i class="fas fa-eye" style="margin-left:2px"></i>
							</span>
						</span>
					</div>
					<div class="txt-box">
						<h2 class="entry-title"><a href="">{{$post['title']}}</a></h2>
						<p>{{$post['lead']}}</p>
						<p class="small">
							<i class="fa fa-calendar-o fa-fw"></i> نوشته شده در {{$post['created_at']}}
							<a href=""
								class="author">{{$post['author']['name'].' '.$post['author']['family']}}
							</a>
						</p>
						<p class="pt10">
							<a href="" class="btn btn-primary">ادامه مطلب</a>
						</p>
						<ul class="category">

						</ul>
					</div>
				</article>
				<!--/.post-box-->
				@endforeach

				@if($posts)
				<!--Pagination-->
				{{-- @component('components.pagination')
                @endcomponent --}}
				<!--/.pagination-->
				@endif

			</div>
			<!-- RIGHT SIDEBAR -->
			{{-- @component('components.right_sidebar')
            @endcomponent --}}
			<!-- right sidebar -->
		</div>
		<!--/.row-->
	</div>
	<!--/.container-->
</section>
<!--/section-->


@endsection

@section('scripts')

<!--JAVASCRIPT-->
<!--===============================================================-->
<!--jQuery-->
<script src="{{asset('startrap/js/jquery.min.js')}}" type="text/javascript"></script>
<!--Bootstrap Core JavaScript-->
<script src="{{asset('startrap/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<!--Parallax Background-->
{{-- <script src="{{asset('startrap/js/jquery.stellar.min.js')}}" type="text/javascript"></script> --}}
<!--Waypoints-->
{{-- <script src="{{asset('startrap/js/waypoints.min.js')}}" type="text/javascript"></script> --}}
<!--Circle Charts-->
{{-- <script src="{{asset('startrap/js/easypiechart.js')}}" type="text/javascript"></script> --}}
<!--Slick Carousel-->
{{-- <script src="{{asset('startrap/js/slick.min.js')}}" type="text/javascript"></script> --}}
<!--Animation-->
{{-- <script src="{{asset('startrap/js/wow.min.js')}}" type="text/javascript"></script> --}}
<!--Contact form-->
{{-- <script src="{{asset('startrap/js/jquery.validate.js')}}" type="text/javascript"></script> --}}
<!--Custom Scripts-->
{{-- <script src="{{asset('startrap/js/scripts.js')}}" type="text/javascript"></script> --}}

<script>
	$(document).ready(function(){
			$('#contact-form').submit(function(e){
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
						$('#contact-form').hide();
						$('#MessageSent').removeClass('hidden');
					}
				});
			});
		});
</script>

@endsection
