<!DOCTYPE html>
<html lang="lt">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title')Maze - Žaidimų Bendruomenė | Žaidimų Forumas | Lietuviški Streamai</title>

		@yield('description')

		<link href="{{ elixir("css/style.css") }}" rel="stylesheet">

		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container">
				<div class="row">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#maze-navbar-collapse" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="/"><img src="/images/logo.svg"></a>
					</div>
					<div class="collapse navbar-collapse" id="maze-navbar-collapse">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="/">Forumas</a></li>
							<!-- <li><a href="http://tv.maze.lt/">TV</a></li> -->
							<li><a href="{{ route('search.index') }}">Paieška</a></li>
						</ul>
					</div>
				</div>
			</div>
		</nav>

		<main id="content">
			<div class="container">
			@include('includes.messages')
					<div class="row">
						<button class="btn btn-success btn-lg btn-block visible-sm visible-xs" id="toggle-sidebar"><i class="fa fa-bars"></i></button>
						<div class="col-md-9 main-content is_visible">
							@yield('breadcrumbs')
							<div class="col-lg-12 content-box">
								@yield('content')
							</div>
						</div>
						<div class="col-md-3 hidden-sm hidden-xs main-sidebar">
							<div id="sidebar-affix-container">
								@include('includes.user_info')
								@yield('sidebar')
							</div>
						</div>
					</div>
			</div>
		</main>

		<footer>
			<div class="container">
				<div class="row">
					<div class="col-lg-10">
						<h4>Apie maze</h4>
						<p>Maze yra būtybė, kurios tikslas yra suteikti "geimeriams" viską, ko gali reikėti propoguojant šį pomėgį. Vienas iš projekto siekių yra išlaikyti kompiuterinių žaidimų žaidėjus įvykių centre, suteikti jiems sąlygas diskutuoti, tobulėti, įgyti naujus įgūdžius, mokytis ir mokyti kitus.</p>
					</div>
					<div class="col-lg-2">
						<h4>Nuorodos</h4>
						<ul>
							<li>
								<a href="{{ route('page.team') }}">Komanda</a>
							</li>
							<li>
								<a href="{{ route('page.about') }}">Apie</a>
							</li>
							<li>
								<a href="{{ route('node.show', 'naujienos') }}">Naujienos</a>
							</li>
							<li>
								<a href="{{ route('page.contact') }}">Susisiekti</a>
							</li>
							<li>
								<a href="{{ route('page.knowledgebase') }}">Žinynas</a>
							</li>
							<li>
								<a href="{{ route('page.rules') }}">Etiketas</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 copyright">
						<p>
							&copy; Maze 2014-{{ date('Y') }}. Visos teisės saugomos.
						</p>
						<p>
							Versija: {{ Config::get('app.version') }}
						</p>
					</div>
				</div>
			</div>
		</footer>
		<script src="{{ elixir("js/scripts.js") }}"></script>
		@yield('scripts')
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-50852877-1', 'auto');
			ga('send', 'pageview');
		</script>
	</body>
</html>