<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">

		<!-- Loading third party fonts -->
		<link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
		<link href="{{ asset('client/fonts/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<!-- Loading third party fonts -->
	<link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
	<link href="{{ asset('client/fonts/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<!-- Loading main css file -->
	<link rel="stylesheet" href="{{ asset('client/style.css') }}">

	<!--[if lt IE 9]>
		<script src="js/ie-support/html5.js"></script>
		<script src="js/ie-support/respond.js"></script>
		<![endif]-->

</head>


<body>

	<div class="site-content">
		<div class="site-header">
			<div class="container">
				<a href="/" class="branding">
					<img src="{{ asset('client/images/logo.png') }}" alt="" class="logo">
					<div class="logo-type">
						<h1 class="site-title">Company name</h1>
						<small class="site-description">tagline goes here</small>
					</div>
				</a>

				<!-- Default snippet for navigation -->
				<div class="main-navigation">
					<button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
					<ul class="menu">
						<li class="menu-item current-menu-item"><a href="index.html">Home</a></li>
						<li class="menu-item"><a href="news.html">News</a></li>
						<li class="menu-item"><a href="live-cameras.html">Live cameras</a></li>
						<li class="menu-item"><a href="photos.html">Photos</a></li>
						<li class="menu-item"><a href="contact.html">Contact</a></li>
					</ul> <!-- .menu -->
				</div> <!-- .main-navigation -->

				<div class="mobile-navigation"></div>

			</div>
		</div> <!-- .site-header -->

		@yield('content')

		<footer class="site-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<form action="#" class="subscribe-form">
							<input type="text" placeholder="Enter your email to subscribe...">
							<input type="submit" value="Subscribe">
						</form>
					</div>
					<div class="col-md-3 col-md-offset-1">
						<div class="social-links">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-google-plus"></i></a>
							<a href="#"><i class="fa fa-pinterest"></i></a>
						</div>
					</div>
				</div>

		<script src="{{ asset('client/js/jquery-1.11.1.min.js') }}"></script>
		<script src="{{ asset('client/js/plugins.js') }}"></script>
		<script src="{{ asset('client/js/app.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <script src="{{ asset('client/script.js') }}"></script>
        @stack('scripts')
	</body>

</html>
