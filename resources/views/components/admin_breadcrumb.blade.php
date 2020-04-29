
<div class="block-header">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<ul class="breadcrumb breadcrumb-style ">
				<li class="breadcrumb-item">
					<h4 class="page-title">{{$slot}}</h4>
				</li>
				<li class="breadcrumb-item bcrumb-1">
					<a href="{{route('admin.home')}}">
						<i class="fas fa-home"></i> خانه</a>
				</li>
				@if($bc1??false)
				<li class="breadcrumb-item bcrumb-1">
					<a href="{{$bcl1}}">
						<i class="fas fa-home"></i> {{$bc1}}</a>
				</li>
				@endif
				@if($bc2??false)
				<li class="breadcrumb-item bcrumb-1">
					<a href="{{$bcl2}}">
						<i class="fas fa-home"></i> {{$bc2}}</a>
				</li>
				@endif
				<li class="breadcrumb-item active">{{$slot}}</li>
			</ul>
		</div>
	</div>
</div>
