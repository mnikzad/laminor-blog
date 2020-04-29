{{-- {{dd($errors)}} --}}
@extends('layouts.admin')

@section('content')

@component('components.admin_breadcrumb')
پروفایل
@endcomponent

@if (session()->has('success'))
<div class="alert alert-success" role="alert">
	{{session()->get('success')}}
</div>
@endif
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">
				<form id='profile-form' method="POST" action="{{route('profile.update')}}">
					@csrf
					@method('put')
					<input type="hidden" name="id" value="{{$user['id']}}">
					<input type="hidden" name="picture" id='avatarname-input'>
					<div class="input-field col-md-4 mx-auto mt-5">
						<input id="name" type="text" required class="validate" name="name"
							value="{{ $user['name'] ?? old('name') }}" required>
						<label for="name">نام</label>
						<span class="helper-text" data-error="wrong format" data-success="right"></span>
						@error('name')
						<span class="text-danger">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="input-field col-md-4 mx-auto">
						<input id="username" type="text" class="validate" name="username"
							value="{{ $user['username'] ?? old('username') }}" required>
						<label for="username">نام کاربری</label>
						<span class="helper-text" data-error="wrong format" data-success="right"></span>
						@error('username')
						<span class="text-danger">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="input-field col-md-4 mx-auto">
						<input id="email" required class="validate" type="email" name='email'
							value="{{ $user['email'] ?? old('email') }}" required>
						<label for="email">آدرس ایمیل</label>
						<span class="helper-text" data-error="invalid format" data-success="right"></span>
						@error('email')
						<span class="text-danger">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="input-field col-md-4 mx-auto">
						<input id="new_password" type="password" class="validate" name="new_password">
						<label for="new_password">رمز عبور جدید (اگر می خواهید رمزتان را تغییر دهید)</label>
						<span class="helper-text" data-error="wrong format" data-success="right"></span>
						@error('new_password')
						<span class="text-danger">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="input-field col-md-4 mx-auto">
						<input id="new_password-comfirm" type="password" class="validate" name="new_password_confirmation">
						<label for="new_password-comfirm">تکرار رمز عبور جدید</label>
					</div>
					<div class="center">
						<button id="profileform-submit" class="btn btn-primary waves-effect" type="submit">اعمال تغییرات</button>
						</button>
					</div>
			</div>
			</form>
		</div>
	</div>
</div>
</div>
@endsection

@section('scripts')
{{-- {{dd(get_defined_vars())}} --}}
<!-- Plugins Js -->
<script src="{{asset('lorax/assets/js/app.min.js')}}"></script>
<script src="{{asset('lorax/assets/js/table.min.js')}}"></script>
<!-- Custom Js -->
<script src="{{asset('lorax/assets/js/admin.js')}}"></script>
<script src="{{asset('lorax/assets/js/pages/tables/jquery-datatable.js')}}"></script>
<script>
	$(document).ready( function () {
	$('#avatar-input').change(function(e){
		console.log('changed');
		$('#avatar-form').submit();
	});
	$('#avatar-form').submit(function(e){
		e.preventDefault();
		var form=$(this);
		var post_url = form.attr('action');
		var post_data = new FormData(form[0]);
		$('#avatar-input').prop('disabled',true);
		console.log(post_data);
		$.ajax({
			type: 'POST',
			url: post_url,
			data: post_data,
			processData: false,
			contentType: false,
			success: function(response){
				console.log(response);
				$('#avatar-input').prop('disabled',false);
				$('#avatar-img').prop('src','../storage/avatars/'+response.data);
				$('#avatarname-input').val(response.data);
			}
		});
	});
} );
</script>
@endsection
