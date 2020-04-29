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
						<img src="{{asset('storage/'.$post['banner_path'])}}" alt="">
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
							<i class="fa fa-calendar-o fa-fw"></i> {{verta($post['created_at'])}}
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

				@auth
				<div class="widget">
					<h4 class="comments-title">ارسال نظر:</h4>
					<form id="comment_form" action="{{route('comment.store')}}" method="POST">
						@csrf
						<input type="hidden" name="post_id" value="{{$post['id']}}">

						<div class="form-group">

							<textarea id="comment_textarea" name='body' class="form-control comments-dark" rows="3"
								placeholder="نظر شما..." style="direction: rtl">{{old('body')}}</textarea>
						</div>
						<button type="submit" class="btn btn-primary">ثبت</button>
					</form>
				</div>
				@endauth

							<!--Posted Comments-->
			@foreach ($post['comments'] as $comment)
			<div class="media">
				<div class="pull-right" href="#">
					<img class="media-object" src="https://api.adorable.io/avatars/112/abott@adorable.png" alt="avatar">
				</div>
				<div class="media-body">
					<h4 class="media-heading">{{$comment['sender']}}
						<small>{{verta($comment['created_at'])}}</small>
					</h4>
					{{$comment['body']}}
				</div>
			</div>
			@endforeach
			<!--Posted Comments-->

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

<script>
$(function(){
	$('#comment_form').submit(function(e){
			e.preventDefault();
			var form=$(this);
			var post_url = form.attr('action');
			var post_data = form.serialize();
			console.log(post_data);
			$.ajax({
				type: 'POST',
				url: post_url,
				data: post_data,
				success: function(response){
					console.log(response);
					if (response.success){
						$($('#comment_form').parent()).append(
							"<div class='text-center'><p class='text-success'>"+
								"<b>نظر شما ثبت شد<b></p></div>"
						);
						$('#comment_form').remove();
					}
				}
			});
		})
})
</script>

@endsection
