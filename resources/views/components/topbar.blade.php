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
			<a class="navbar-brand" href=""><img src="{{asset('startrap/img/laminor.png')}}" alt="Startrap"></a>
		</div>
		<!--/.navbar-header-->
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-left">
				<li><a href="index-dark.html#about">درباره ما</a></li>
				<li><a href="">تماس</a></li>
				@guest
				<li><a href="">ورود</a></li>
				@endguest
				@auth
				<li><a href="">پنل ادمین</a></li>
				@endauth
			</ul>
			<!--/.navbar-nav-->
		</div>
		<!--/.navbar-collapse-->
	</div>
	<!--/.container-->
</nav>
