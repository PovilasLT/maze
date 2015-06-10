<!DOCTYPE html>
<html lang="lt">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title')Maze - Žaidimų Bendruomenė | Žaidimų Forumas | Lietuviški Streamai</title>

		<!-- Bootstrap CSS -->
		<link href="/css/style.css" rel="stylesheet">

		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 text-right">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="#">Maze</a>
						</div>
				
						<div class="collapse navbar-collapse navbar-ex1-collapse">
							<ul class="nav navbar-nav">
								<li class="active"><a href="#"><i class="fa fa-film fa-primary"></i> TV</a></li>
								<li><a href="#"><i class="fa fa-comments-o fa-primary"></i> Forumas</a></li>
								<li><a href="#"><i class="fa fa-pencil-square-o fa-primary"></i> Blogai</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 navbar-user-info">
						@if(Auth::check())
							<a href="#"><img src="https://placekitten.com/g/40/40" alt="{{ Auth::user()->username }} Profilis" class="avatar"></a>
							<a href=""><i class="fa fa-globe"></i></a>
							<a href=""><i class="fa fa-envelope-o"></i></a>
							<a href="{{ route('auth.logout') }}"><i class="fa fa-sign-out"></i></a>
						@else
						<a href="{{ route('auth.register') }}">Registruotis</a> | <a href="{{ route('auth.login') }}">Prisijungti</a>
						@endif
					</div>
				</div>
			</div>
		</nav>

		<main>
			<div class="container">
					<div class="row">
						<div class="col-lg-9 main-content">
							@yield('breadcrumbs')
							<div class="col-lg-12 content-box">
								@yield('content')
							</div>
						</div>
						<div class="col-lg-3 main-sidebar">
							@yield('sidebar')
						</div>
					</div>
			</div>
		</main>

		<script src="/js/scripts.js"></script>

		@yield('scripts')
	</body>
</html>