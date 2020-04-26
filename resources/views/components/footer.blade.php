<footer>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-lg-5 newsletter fr">
				<h3>
					عضویت در <strong>خبرنامه</strong>
				</h3>
				<p class="small pt5 pb10">
					لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون
					بلکه روزنامه و مجله.
				</p>
				<!--Newsletter Form-->
				<div class="subscribe-container">
					<div class="alert alert-success hidden" id="EmailSent">
						ایمیل شما ثبت شد.
					</div>
					<div class="alert alert-danger hidden" id="EmailSent">
						اوه! اشتباهی رخ داد، لطفا دوباره امتحان کنید.
					</div>
					<form action="" method="POST" id="subscribe-form">
						@csrf
						<div class="subscribe-form">
							<input type="email" name="email" placeholder="ایمیل خود را وارد کنید...">
							<button type="submit"><i class="fa fa-send"></i></button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-6 col-lg-6 col-lg-offset-1 fl">
				<h3>
					برخی از <strong>کلمات کلیدی</strong>
				</h3>
				<ul class="Keywords">
					{{-- @foreach ($footerData['tags'] as $tag)
					<li style="white-space: nowrap">
						<a href="?tag='.$tag['id']}}">{{$tag['name']}}</a></li>
					@endforeach --}}
				</ul>
			</div>
		</div>
		<!--/.row-->
		<div class="row footer2">
			<div class="col-sm-12">
				<hr>
			</div>
			<div class="col-sm-6 fr">
				<p class="copyright"></p>
			</div>
			<div class="col-sm-6 text-left">
				<!--Bottom Links-->
				<ul class="list-inline small">
					<li><a href="">درباره ما</a></li>
					<li class="footer-menu-divider"><i class="fa fa-circle-o"></i></li>
					<li><a href=">شرایط استفاده</a></li>
					<li class="footer-menu-divider"><i class="fa fa-circle-o"></i></li>
					<li><a href="" class="scroll-nav">تماس با ما</a></li>

				</ul>
			</div>
		</div>
	</div>
	<!--/.container-->
</footer>
