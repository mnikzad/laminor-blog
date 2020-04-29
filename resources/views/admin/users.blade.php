@extends('layouts.admin')

@section('content')

@component('components.admin_breadcrumb')
اعضا
@endcomponent
@if (session()->has('success'))
<div class="alert alert-success" role="alert">
	{{session()->get('success')}}
</div>
@endif
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2><strong>لیست</strong> کاربران</h2>
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-hover js-basic-example contact_list">
						<thead>
							<tr>
								<th class="sorting_asc" style="width: 40px">نام</th>
								<th class="center sorting_asc" style="width: 20px">نام کابری</th>
								<th class="center sorting_asc" style="width: 20px">ایمیل</th>
								<th class="center sorting_asc" style="width: 20px">سطح کاربری</th>
								<th class="center sorting_asc" style="width: 30px">اقدامات</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($users as $user)
							<tr>
								<td class="center">{{$user['name']}}</td>
								<td class="center">{{$user['username']}}</td>
								<td class="center">{{$user['email']}}</td>
								<td>{{implode('-',Arr::pluck($user['roles'],'name'))}}</td>
								<td class="center">
									<a href="{{route('admin.user.edit',$user['id'])}}">
										<button class="btn tblActnBtn">
											<i class="material-icons">mode_edit</i>
										</button>
									</a>
									<form action="{{route('admin.user.destroy',$user['id'])}}" method="POST" style="display:inline">
									@csrf
									@method('delete')
									<input type="hidden" name="id" value="{{$user['id']}}'">
									<button class="btn tblActnBtn" type="submit" display="inline">
										<i class="material-icons">delete</i>
									</button>
									</form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<!-- Plugins Js -->
<script src="{{asset('lorax/assets/js/app.min.js')}}"></script>
<script src="{{asset('lorax/assets/js/table.min.js')}}"></script>
<!-- Custom Js -->
<script src="{{asset('lorax/assets/js/admin.js')}}"></script>
<script src="{{asset('lorax/assets/js/pages/tables/jquery-datatable.js')}}"></script>
@endsection
