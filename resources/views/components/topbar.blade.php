<nav class="navbar navbar-inverse navbar-fixed-top nav-color" id="menu">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
				aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">تعویض ناوبری</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{route('home')}}" style="padding:0">
				<img src="{{asset('startrap/img/laminor.png')}}" alt="Startrap" style="max-height:100%" >
			</a>
		</div>
		<!--/.navbar-header-->
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-left">
				@guest
				<li><a href="{{route('login')}}">ورود</a></li>
				<li><a href="{{route('registerForm')}}">ثبت نام</a></li>
				@endguest
				@auth
				<li><a href="{{route('admin.home')}}">پنل کاربری</a></li>
				<li><a href="{{route('logout')}}">خروج</a></li>
				@endauth
			</ul>
			<!--/.navbar-nav-->
		</div>
		<!--/.navbar-collapse-->
	</div>
	<!--/.container-->
</nav>
