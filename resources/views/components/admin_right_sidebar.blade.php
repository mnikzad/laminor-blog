{{-- {{dd(get_defined_vars())}} --}}
<aside id="leftsidebar" class="sidebar">
	<!-- Menu -->
	<div class="menu">
		<ul class="list">
			<li class="sidebar-user-panel active">
				<a href="{{route('profile')}}">
					<div class="user-panel">
					</div>
					<div class="profile-usertitle">
						<div class="sidebar-userpic-name"> {{$rightbarData['user']['name']}}
						</div>
						<div class="profile-usertitle-job ">{{__($rightbarData['role'])}} </div>
					</div>
				</a>
			</li>
			<li class="active">
				<a href="{{route('admin.home')}}">
					<i class="fas fa-tachometer-alt"></i>
					<span>خانه</span>
				</a>
			</li>
			@if(Auth::user()->isAdmin())
			<li>
				<a href="javascript:void(0);" class="menu-toggle">
					<i class="fab fa-google-play"></i>
					<span>کاربران</span>
				</a>
				<ul class="ml-menu">
					<li>
						<a href="{{route('admin.user.index')}}">لیست</a>
					</li>
					<li>
						<a href="{{route('admin.user.create')}}">ایجاد کاربر جدید</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="javascript:void(0);" class="menu-toggle">
					<i class="fab fa-google-play"></i>
					<span>پست‌ها</span>
				</a>
				<ul class="ml-menu">
					<li>
						<a href="{{route('admin.post.index')}}">لیست</a>
					</li>
					<li>
						<a href="{{route('admin.post.create')}}">ایجاد پست جدید</a>
					</li>
				</ul>
			</li>
			@endif
		</ul>
	</div>
	<!-- #Menu -->
</aside>
