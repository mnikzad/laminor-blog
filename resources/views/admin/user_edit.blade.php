@extends('layouts.admin')

@section('content')

@component('components.admin_breadcrumb')
@slot('bc1')
اعضا
@endslot
@slot('bcl1')
{{route('admin.user.index')}}
@endslot
ویرایش اعضا
@endcomponent
@if (session()->has('success'))
<div class="alert alert-success" role="alert">
	{{session()->get('success')}}
</div>
@endif
@php($editmode=isset($user))
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2><strong>ویرایش</strong> کاربران</h2>
			</div>
			<div class="body">
				<form action="{{$editmode ? route('admin.user.update',$user['id']) : route('admin.user.store')}}" id="form" method="POST">
					@csrf
					@if($editmode)
					@method('put')
					<input type="hidden" name="id" value="{{$user['id']}}">
					@endif


					<div class="input-field col-md-3">
						<input id="name" type="text" required class="validate" name="name" value="{{ $editmode?$user['name']:old('name') }}"
							required>
						<label for="name">نام</label>
						<span class="helper-text" data-error="wrong format" data-success="right"></span>
						@error('name')
						<span class="text-danger">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="input-field col-md-3">
						<input id="email" required class="validate" type="email" name='email'
							value="{{ $editmode?$user['email']:old('email') }}" required>
						<label for="email">آدرس ایمیل</label>
						<span class="helper-text" data-error="invalid format" data-success="right"></span>
						@error('email')
						<span class="text-danger">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="input-field col-md-4">
						<input id="username" type="text" class="validate" name="username"
							value="{{ $editmode?$user['username']:old('username') }}">
						<label for="username">نام کاربری</label>
						<span class="helper-text" data-error="wrong format" data-success="right"></span>
						@error('username')
						<span class="text-danger">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="row form-group">
						<div class="input-field col-md-4 ">
							<input id="password" type="password" class="validate" name="password" {{$editmode ? '' : 'required'}}>
							<label for="password">{{$editmode?'رمز عبور جدید (اگر می خواهید رمز را تغییر دهید)':'رمز عبور'}}</label>
							<span class="helper-text" data-error="wrong format" data-success="right"></span>
							@error('password')
							<span class="text-danger">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<div class="input-field col-md-4 ">
							<input id="password-comfirm" type="password" class="validate" name="password_confirmation" {{$editmode ? '' : 'required'}}>
							<label for="password-comfirm">{{$editmode?'تکرار رمز عبور جدید':'تکرار رمز عبور'}}</label>
						</div>
					</div>
					<div class="form-group multiple">
						<span class="ml-4">سطح کاربری:</span>
						@foreach ($roles as $role)
						<label class="ml-5">
							<input type="checkbox" name="roles[]" class="role" value="{{$role['id']}}"
							@if ($editmode && in_array($role['id'],Arr::pluck($user['roles'], 'id')))
								{{'checked=true'}}
							@endif
							/>
							<span>{{__($role['name'])}}</span>
						</label>
						@endforeach
					</div>


					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-6 mt-4">
							<div class="btn-group m-l-15">
								<button id="addRow" class="btn btn-info">
									تایید
									<i class="fa fa-plus"></i>
								</button>
							</div>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<!-- Plugins Js -->
<script src="{{asset('lorax/assets/js/app.min.js')}}"></script>
<!-- Custom Js -->
<script src="{{asset('lorax/assets/js/admin.js')}}"></script>
{{-- <script src="{{asset('utils/dropzone.js')}}"></script> --}}
<script>

</script>
@endsection
