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
							<img src="{{asset('storage/'.$post['banner_path'])}}" alt=""
								style="max-height:fill-available;max-height:-moz-available;max-height:-webkit-fill-available;object-fit:cover">
						<span class="comment-num">
							<span>
								{{$post['comments_count']}}
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
							<i class="fa fa-calendar-o fa-fw"></i> نوشته شده در {{verta($post['created_at'])}}
							<a href="" class="author">{{$post['author']['name'].' '.$post['author']['family']}}
							</a>
						</p>
						<p class="pt10">
						<a href="{{route('post.show',$post['id'])}}" class="btn btn-primary">ادامه مطلب</a>
						</p>
						<ul class="category">

						</ul>
					</div>
				</article>
				<!--/.post-box-->
				@endforeach

				@if($posts)
				<!--Pagination-->
			{{ $posts->links() }}
				<!--/.pagination-->
				@endif

			</div>

			<!-- RIGHT SIDEBAR -->
			@component('components.right_sidebar')
			@endcomponent
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

@endsection
