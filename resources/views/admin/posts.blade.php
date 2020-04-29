@extends('layouts.admin')

@section('content')

@component('components.admin_breadcrumb')
پست‌ها
@endcomponent

@if (session()->has('success'))
<div class="alert alert-success" role="alert">
	{{session()->get('success')}}
</div>
@endif
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2><strong>لیست</strong> پست‌ها</h2>
			</div>
			<div class="body">
				<div class="table-responsive">
					<div id="chieldRow_wrapper" class="dataTables_wrapper dt-bootstrap4">
						<div class="row">
							<div class="col-sm-12">
								<table class="table-hover">
									<thead>
										<tr role="row">
											<th style="width: 13px;">#</th>
											<th style="width: 500px;">عنوان</th>
											<th style="width: 150px;">نویسنده</th>
											<th style="width: 150px;">تاریخ</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($posts as $post)
										<tr>
											<td>
												<a data-toggle="collapse" href="#collapsed-{{$loop->iteration}}" class="accordion-toggle">
													<i class="material-icons">add</i>
												</a>
											</td>
											<td>{{$post['title']}}</td>
											<td>{{$post['author']['name']}}</td>
											<td>{{$post['created_at']}}</td>
										</tr>
										<tr>
											<td colspan="6" class="hiddenRow" style="padding:0">
												<div class="accordion-body collapse mx-5 mt-4" id="collapsed-{{$loop->iteration}}">{{$post['lead']}}
													<div class="my-4">
														<form action="{{route('post.show',$post['id'])}}" method="GET" style="display:inline">
															<button class="mr-3 btn btn-default waves-effect waves-red">{{__('show')}}</button>
														</form>
														<form action="{{route('admin.post.edit',$post['id'])}}" method="GET" style="display:inline">
															<button class="mr-3 btn btn-default waves-effect waves-red">{{__('edit')}}</button>
														</form>
														<form action="{{route('admin.post.destroy',$post['id'])}}" method="POST" style="display:inline">
															@csrf
															@method('delete')
															<button class="mr-3 btn btn-default waves-effect waves-red">{{__('delete')}}</button>
														</form>
													</div>
												</div>
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
    $('table').DataTable();
} );
</script>
@endsection
