<!DOCTYPE html>
<html lang="lt">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title')Maze - Žaidimų Bendruomenė | Žaidimų Forumas | Lietuviški Streamai</title>

		@yield('description')

		<link href="/css/style.css" rel="stylesheet">

		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<link href="/vendor/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
		<link href="/vendor/confer/css/confer.css" rel="stylesheet">
		@include('confer::confer')

		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container">
				<div class="row">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navbar-ex1-offcanvas" data-canvas="body">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="/"><img src="/images/logo.svg"></a>
					</div>
			
					<div class="navmenu navmenu-default navmenu-fixed-left offcanvas navbar-ex1-offcanvas">
						<ul class="nav navbar-nav">
							@include('includes.user_info')
							<li class="active"><a href="#"><i class="fa fa-film fa-primary"></i> TV</a></li>
							<li><a href="#"><i class="fa fa-comments-o fa-primary"></i> Forumas</a></li>
						</ul>
					</div>
				</div>
			</div>
		</nav>

		<main id="content">
			<div class="container">
			@include('includes.messages')
					<div class="row">
						<div class="col-lg-9 main-content">
							@yield('breadcrumbs')
							<div class="col-lg-12 content-box">
								@yield('content')
							</div>
						</div>
						<div class="col-lg-3 main-sidebar">
							@include('includes.user_info')
							@yield('sidebar')
						</div>
					</div>
			</div>
		</main>

		<footer>
			<div class="container">
				<div class="row">
					<div class="col-lg-7">
						<h4>Apie maze</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi feugiat orci id augue aliquet, id pellentesque nisl imperdiet. Quisque nec accumsan velit, et placerat ligula. Integer at aliquet est. Donec interdum lorem eu purus pulvinar faucibus. Nullam magna erat, facilisis vitae risus vel, elementum varius neque. Suspendisse feugiat faucibus lorem ut congue. Suspendisse tincidunt viverra porttitor. Proin tristique vehicula arcu, eu consequat libero. Morbi placerat dolor justo, vel maximus eros aliquam in. Mauris fermentum dui at nisl viverra, sit amet feugiat mi sollicitudin. Vivamus felis dolor, hendrerit in dictum quis, ullamcorper sed quam.</p>
					</div>
					<div class="col-lg-2">
						<h4>Nuorodos</h4>
						<ul>
							<li>
								<a href="#">Komanda</a>
							</li>
							<li>
								<a href="#">Apie</a>
							</li>
							<li>
								<a href="#">Naujienos</a>
							</li>
							<li>
								<a href="#">Susisiekti</a>
							</li>
							<li>
								<a href="#">Žinynas</a>
							</li>
						</ul>
					</div>
					<div class="col-lg-3">
						<h4>Kontaktai</h4>
						<ul>
							<li>Informacija: </li>
							<li>Reklama: </li>
							<li>Bendradarbiavimas: </li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 copyright">
						&copy; Maze 2014-2015. Visos teisės saugomos.
					</div>
				</div>
			</div>
			<div class="current-date-invisible" style="display: none;">{{ \Carbon\Carbon::now() }}</div>
		</footer>
		<script src="/js/scripts.js"></script>
		<script src="/vendor/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
		<script src="/vendor/pusher/assets/js/pusher.min.js"></script>

		@yield('scripts')

		@include('confer::js')
	</body>
</html>