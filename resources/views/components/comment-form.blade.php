<div class="widget">
	<h4 class="comments-title">ارسال نظر:</h4>
	<form id="comment_form" action="{{$cmSubmit}}" method="POST">
		@csrf
		<input type="hidden" name="post_id" value="{{$postId}}">
		<input type="hidden" id="cmform_pid" name="parent_id" value="">
		<div class="form-group">
			<input type="text" class="form-control comments-dark" name="sender" placeholder="نام" style="direction: rtl"
				value="{{old('sender')}}">
		</div>
		<div class="form-group">
			<input type="email" class="form-control comments-dark" name="sendermail" placeholder="آدرس ایمیل"
				style="direction: rtl" value="{{old('sendermail')}}">
		</div>
		<div class="form-group">
			<div class="alert alert-info text-right" id="replyto_alert" role="alert" style="padding:5px; margin:0; display:none">
				<button type="button" id="replyto_close" class="close pull-left" style="right:-10px"><span>&times;</span></button>
				<span>
					پاسخ به نظر <strong id="replyto_name"></strong>
				</span>
			</div>
			<textarea id="comment_textarea" name='body' class="form-control comments-dark" rows="3" placeholder="نظر شما..."
				style="direction: rtl">{{old('body')}}</textarea>
		</div>
		<button type="submit" class="btn btn-primary">ثبت</button>
	</form>
</div>
