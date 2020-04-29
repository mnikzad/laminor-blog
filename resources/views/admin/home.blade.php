@extends('layouts.admin')

@section('content')

@component('components.admin_breadcrumb')
خانه
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
				<h2><strong>خانه</strong></h2>
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
