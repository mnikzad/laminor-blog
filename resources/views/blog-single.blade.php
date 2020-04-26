@extends('layouts.blog')

@component('components.header')
@endcomponent

@section('content')
<!--BLOG-->
<!--===============================================================-->
<section class="content-section-a parallax" data-stellar-background-ratio="0.5" id="blog">
	<div class="container">
		<div class="row">
			<div class="main col-sm-8">
				<article class="post-box list-single mb30">
					<div class="img-box">
						<img src="{{$post['banner_path']??''}}" alt="">
						<span class="comment-num">
							<span>
								{{-- {{$commentsNum}} --}}
								<i class="fas fa-comment" style="margin-left:2"></i>
							</span>
							<span style="margin-left:7">
								{{$post['views']}}
								<i class="fas fa-eye" style="margin-left:2"></i>
							</span>
						</span>
					</div>
					<div class="txt-box">
						<h2 class="entry-title">{{$post['title']}}</h2>
						<p class="lead">{{$post['lead']??""}}</p>
						<p class="small">
							<i class="fa fa-calendar-o fa-fw"></i> {{$post['created_at']}}
							{{-- <a href="{{$urls['list'].'?author='.$author['id']}}"
							class="author">{{$author['name'].' '.$author['family']}}
							</a> --}}
						</p>
						<div class="body">
							<p>
								{!!$post['body']!!}
							</p>
						</div>
						<ul class="category">
							{{-- @foreach ($categories as $category)
							<li><a href="{{$urls['list'].'?cat='.$category['id']}}">{{$category['name']}}</a></li> --}}
							{{-- @endforeach --}}
						</ul>
					</div>
				</article>
				<!--/.post-box-->

				{{-- @if (!($nocomments ?? false))
				<!--Comments Form-->
				@component('components.comment-form')
				@slot('cmSubmit')
				{{$urls['submitcm']}}
				@endslot
				@slot('postId')
				{{$post['id']}}
				@endslot
				@endcomponent --}}
				<!--/.widget-->
				{{-- <hr class="clearfix mt30 mb30">
				<!--Posted Comments-->
				<section id="comments-section">
					@csrf
					<div>
						<button type="button" id="loadmore_btn" class="btn btn-light btn-block">
							بیشتر
						</button>
					</div>
				</section>
				<!--Posted Comments-->
				@endif --}}

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
{{-- <script src="js/jquery.stellar.min.js" type="text/javascript"></script> --}}
<!--Waypoints-->
{{-- <script src="js/waypoints.min.js" type="text/javascript"></script> --}}
<!--Circle Charts-->
{{-- <script src="js/easypiechart.js" type="text/javascript"></script> --}}
<!--Slick Carousel-->
{{-- <script src="js/slick.min.js" type="text/javascript"></script> --}}
<!--Animation-->
{{-- <script src="js/wow.min.js" type="text/javascript"></script> --}}
<!--Contact form-->
{{-- <script src="js/jquery.validate.js" type="text/javascript"></script> --}}
<!--Custom Scripts-->
{{-- <script src="js/scripts.js" type="text/javascript"></script> --}}

<script>

</script>

@endsection
