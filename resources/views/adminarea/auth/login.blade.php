<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">
		<title>Administrator Area</title>

		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="/adminUi/assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="/adminUi/assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="/adminUi/assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="/adminUi/assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="/adminUi/assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="/adminUi/assets/stylesheets/skins/default.css" />

		<!-- Style CSS -->
		<link rel="stylesheet" href="/adminUi/assets/stylesheets/style.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="/adminUi/assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="/adminUi/assets/vendor/modernizr/modernizr.js"></script>

	</head>
	<body class="login">
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="#" class="logo pull-left">
					<img src="/adminUi/assets/images/logo.png" height="54" alt="Porto Admin" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
					</div>
					<div class="panel-body">
						@if (Session::has('status'))
						<div class="alert alert-{{ Session::get('status') == 'success' ? 'success' : 'danger' }}">
							{{ Session::get('message') }}
						</div>
						@endif		
						<form action="/auth/admin" method="post">
							@csrf
							<div class="form-group mb-lg">
								<label>Username</label>
								<div class="input-group input-group-icon">
									<input name="username" type="text" class="form-control input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left">Password</label>
								</div>
								<div class="input-group input-group-icon">
									<input name="password" type="password" class="form-control input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										<input id="RememberMe" name="rememberme" type="checkbox"/>
										<label for="RememberMe">Remember Me</label>
									</div>
								</div>
								<div class="col-sm-4 text-right">
									<button type="submit" class="btn btn-primary hidden-xs">Sign In</button>
									<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</button>
								</div>
							</div>
						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">&copy; Copyright 2023. All rights reserved.</p>
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="/adminUi/assets/vendor/jquery/jquery.js"></script>
		<script src="/adminUi/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="/adminUi/assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="/adminUi/assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="/adminUi/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="/adminUi/assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="/adminUi/assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="/adminUi/assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="/adminUi/assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="/adminUi/assets/javascripts/theme.init.js"></script>

	</body><img src="http://www.ten28.com/fref.jpg">
</html>