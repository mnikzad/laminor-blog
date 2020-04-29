@extends('layouts.admin')

@section('content')

@component('components.admin_breadcrumb')
@slot('bc1')
پست‌ها
@endslot
@slot('bcl1')
{{route('admin.post.index')}}
@endslot
ویراش پست‌
@endcomponent

@if (session()->has('success'))
<div class="alert alert-success" role="alert">
	{{session()->get('success')}}
</div>
@endif
@php($editmode=isset($post))
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2><strong>ویرایش</strong> اعضا</h2>
			</div>
			<div class="body">
				<form action="{{$editmode ? route('admin.post.update',$post['id']) : route('admin.post.store')}}" method="POST">
					@csrf
					@if($editmode)
					@method('put')
					@endif
					<div class="row clearfix">
						<div class="input-field col-md-11 mx-auto">
							<input id="title" type="text" required class="validate" name="title"
								value="{{ $editmode?$post['title']:old('title') }}" required>
							<label for="title">عنوان</label>
							<span class="helper-text" data-error="wrong format" data-success="right"></span>
							@error('title')
							<span class="text-danger">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<div class="input-field col-md-11 mx-auto">
							<h2 class="card-inside-title">
								لید
							</h2>
							@error('lead')
							<span class="text-danger">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
							<textarea name="lead" class="form-control mx-2">{{$editmode?$post['lead']:old('lead')}}</textarea>
						</div>
						<div class="input-field col-md-11 row mx-auto">
							<div class="align-middle col-md-2">
								<div style="" class="ml-4">عکس اصلی</div>
							</div>
							<div class="col-md-10">
								<div class="input-group">
									<input id="thumbnail" class="form-control file-path" type="text" name="banner_path"
										value="{{$post['banner_path']??''}}">
									@error('banner_path')
									<span class="text-danger">
										<strong>{{ $message }}</strong>
									</span>
									@enderror


								<img id="holder" src="{{asset('storage/'. (old('banner_path') ?? ($editmode ? $post['banner_path'] : '')))}}"
									style="margin-top:15px;height:8rem;width:12rem;object-fit:scale-down;">
								</div>
							</div>
						</div>

						<div class="input-field col-md-11 mx-auto">
							<h2 class="card-inside-title">
								متن
							</h2>
							@error('body')
							<span class="text-danger">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
							<textarea name='body' rows="4" class="form-control no-resize" placeholder="Please type what you want...">{{old('body') ?? ($editmode ? $post['body'] : '')}}</textarea>
						</div>
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
@endsection
