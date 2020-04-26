{{-- {{dd($paginator)}} --}}
@if($paginator)
<ul class="pagination pagination-sm mt10">
	<li class="@if($paginator['current_page']==1){{'disabled'}}@endif">
		<a href="{{$paginator['first_page_url']}}" title="اولین">
			<i class="fa fa-angle-double-right small"></i></a></li>

	@if($paginator['prev_page_url'])
	<li>
		<a href="{{$paginator['prev_page_url']}}" title="قبلی">
			<i class="fa fa-angle-right small"></i></a></li>
	@endif

	@if($paginator['current_page']>1)
	<li><a href="{{$paginator['prev_page_url']}}">
			{{$paginator['current_page']-1}}
		</a></li>
	@endif

	<li class="active"><a href="#">
			{{$paginator['current_page']}}
		</a></li>

	@if($paginator['current_page'] < $paginator['last_page'])
	<li><a href="{{$paginator['next_page_url']}}">
			{{$paginator['current_page']+1}}
		</a></li>
	@endif

	@if($paginator['next_page_url'])
	<li>
		<a href="{{$paginator['next_page_url']}}" title="بعدی">
			<i class="fa fa-angle-left small"></i></a></li>
	@endif

	<li class="@if ($paginator['current_page']==$paginator['last_page']){{'disabled'}}@endif">
		<a href="{{$paginator['last_page_url']}}" title="آخرین">
			<i class="fa fa-angle-double-left small"></i></a></li>
</ul>
@endif
