{{-- {{dd($urls)}} --}}
<aside class="col-sm-4 sidebar">
	<!--Blog Search-->
	<div class="widget">
		<h3>جستجوی وبلاگ</h3>
		<form action="" method="GET" style="display:inline">
			<div class="input-group">
				<input name="q" type="text" class="form-control" placeholder="جستجو در وبلاگ...">
				<span class="input-group-btn">
					<button class="btn btn-default" type="submit">
						<i class="fa fa-search"></i>
					</button>
				</span>
			</div>
		</form>
		<!--/.input-group-->
	</div>
	<!--/.widget-->
	<!--Blog Categories-->
	<div class="widget">
		<h3>دسته بندی وبلاگ</h3>
		<div class="row">
			<div class="col-lg-12">
				<ul class="list-unstyled" style="column-count:2;direction:rtl">
					@foreach ($sidebarData['categories'] as $key => $category)
					<li><a href="{{$sidebarData['urls']['list'].'?cat='.$category['id']}}">
							{{$category['name']}}
						</a>
					</li>
					@endforeach
				</ul>
			</div>

		</div>
		<!--/.row-->
		<div class="text-center">
			<a href="">
				<h5 style="color: #58c4c4">مشاهده همه</h5>
			</a>
		</div>
	</div>
	<!--/.widget-->
	<!--Side Widget-->
	<div class="widget">
		<h3>آخرین مطلب</h3>
		<div class="tabbable-panel">
			<div class="tabbable-line">
				<ul class="nav nav-tabs ">
					<li class="active">
						<a href="#features" data-toggle="tab">
							برجسته</a>
					</li>
					<li>
						<a href="#popular" data-toggle="tab">
							پربازدید</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="features">
						<ul class="recent-posts">
							@foreach ($sidebarData['featuredPosts'] as $featpost)
							<li><a href="{{$sidebarData['urls']['show'].'?post='.$featpost['id']}}">
									{{str_limit($featpost['title'],50,'...')}}
								</a></li>
							@endforeach
						</ul>
					</div>
					<div class="tab-pane" id="popular">
						<ul class="recent-posts">
							@foreach ($sidebarData['recentPosts'] as $recpost)
							<li><a href="{{$sidebarData['urls']['show'].'?post='.$recpost['id']}}">
									{{str_limit($recpost['title'],50,'...')}}
								</a></li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/.widget-->
	<!--Advertising-->
	<div class="widget ads">
		<a href="{{$sidebarData['ad']['target']}}" target="_blank">
			<img src="{{$sidebarData['ad']['url'] ?? '/storage/'.$sidebarData['ad']['path']}}" alt="ads">
		</a>
	</div>
	<!--/.widget-->
</aside>
