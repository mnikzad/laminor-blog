<nav class="navbar">
	<div class="container-fluid">
		<div class="navbar-header">
			<a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse"
				data-target="#navbar-collapse" aria-expanded="false"></a>
			<a href="javascript:void(0);" class="bars"></a>
			<a class="navbar-brand" href="{{route('home')}}">
				<img src="../../images/ic_logo_big.png" alt="" />
				<span class="logo-name">وبلاگ لامینور</span>
			</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse">
			<ul class="pull-right">
				<li>
					<a href="javascript:void(0);" class="sidemenu-collapse">
						<i class="material-icons">reorder</i>
					</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<!-- Full Screen Button -->
				<li class="fullscreen">
					<a href="javascript:;" class="fullscreen-btn">
						<i class="fas fa-expand"></i>
					</a>
				</li>
				<li>
					<a href="{{route('profile')}}">
						<i class="material-icons">person</i>پروفایل
					</a>
				</li>
				<li>
				<li>
					<a href="{{route('logout')}}">
						<i class="material-icons">power_settings_new</i>خروج
					</a>
				</li>
				<ul class="dropdown-menu pullDown">
					<li class="body">
						<ul class="user_dw_menu">

						</ul>
					</li>
				</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
