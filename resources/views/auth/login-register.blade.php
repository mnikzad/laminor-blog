<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<title>Lorax - Bootstrap 4 Admin Dashboard Template</title>
	<!-- Favicon-->
	<link rel="icon" href="../lorax/assets/images/favicon.ico" type="image/x-icon">
	<!-- Plugins Core Css -->
	<link href="../lorax/assets/css/app.min.css" rel="stylesheet">
	<link href="../lorax/assets/js/bundles/materialize-rtl/materialize-rtl.min.css" rel="stylesheet">
	<!-- Custom Css -->
	<link href="../lorax/assets/css/style.css" rel="stylesheet" />
	<link href="../lorax/assets/css/pages/extra_pages.css" rel="stylesheet" />
</head>

<body class="light rtl">
	<div class="loginmain">
		<div class="loginCard">
			<div class="login-btn splits">
				<p>در حال حاضر یک کاربر هستید؟</p>
				<button class="active">ورود</button>
			</div>
			<div class="rgstr-btn splits">
				<p>هنوز حساب کاربری ندارید؟</p>
				<button>ثبت نام</button>
			</div>
			<div class="wrapper">
				<form id="login" tabindex="500">
					<h3>ورود</h3>
					<div class="mail">
						<input type="email">
						<label>ایمیل، نام کاربری یا شماره موبایل</label>
					</div>
					<div class="passwd">
						<input type="password">
						<label>رمز عبور</label>
					</div>
					<div class="text-right p-t-8 p-b-31">
						<a href="#">
							رمز عبور را فراموش کرده‌اید؟
						</a>
					</div>
					<div class="submit">
						<button class="dark">ورود</button>
					</div>
				</form>
				<form id="register" tabindex="502">
					<h3>ثبت نام</h3>
					<div class="name">
						<input type="text">
						<label>نام</label>
					</div>
					<div class="name">
						<input type="text">
						<label>نام</label>
					</div>
					<div class="name">
						<input type="text">
						<label>نام</label>
					</div>
					<div class="mail">
						<input type="email">
						<label>ایمیل</label>
					</div>
					<div class="uid">
						<input type="text">
						<label>نام کاربری</label>
					</div>
					<div class="passwd">
						<input type="password">
						<label>رمز عبور</label>
					</div>
					<div class="passwd">
						<input type="password">
						<label>تکرار رمز عبور</label>
					</div>
					<div class="submit">
						<button class="dark">ثبت نام</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Plugins Js -->
	<script src="../lorax/assets/js/app.min.js"></script>
	<!-- Extra page Js -->
	<script src="../lorax/assets/js/pages/examples/login-register.js"></script>
</body>

</html>
