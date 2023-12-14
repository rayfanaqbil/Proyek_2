<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{  asset('css/style.css') }}">
	<link rel="stylesheet"  href="{{ asset('css/bootstrap-theme.css') }}">
	<script  src="{{  asset('js/jquery.js') }}"></script>
	<script  src="{{  asset('js/bootstrap.min.js') }}"></script>
    <title>Laravel Toko Roti</title>
</head>
<body>
    <div class="container-fluid">
		<div class="row top">
			<center>
				<div class="col-md-4" style="padding: 3px;">
					<span> <i class="glyphicon glyphicon-earphone"></i> +6285884703267</span>
				</div>


				<div class="col-md-4"  style="padding: 3px;">
					<span><i class="glyphicon glyphicon-envelope"></i>bakerybreadhouse@gmail.com</span>
				</div>


				<div class="col-md-4"  style="padding: 3px;">
					<span>bakery bread house</span>
				</div>
			</center>
		</div>
	</div>

	<nav class="navbar navbar-default" style="padding: 5px;">
		<div class="container">

			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#" style="color:#FDCE87;"><b>BAKERY-BREAD HOUSE</b></a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="{{ route('home') }}">Home</a></li>
					<li><a href="{{ route('produk') }}">Produk</a></li>
					<li><a href="">Tentang Kami</a></li>
					<li><a href="">Manual Aplikasi</a></li>

					@guest('customer')
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="glyphicon glyphicon-user"></i> Akun <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="{{ route('login_form') }}">Login</a></li>
							<li><a href="{{ route('register_form') }}">Register</a></li>
						</ul>
					</li>
				@else
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="glyphicon glyphicon-user"></i> {{ session('user') }} <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ route('logout', ['guard' => 'customer']) }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
									Logout
								</a>
								<form id="logout-form" action="{{ route('logout', ['guard' => 'customer']) }}" method="POST" style="display: none;">
									@csrf
								</form>
							</li>
						</ul>
					</li>
				@endguest				
				</ul>
			</div>
		</div>
	</nav>
</body>
</html>