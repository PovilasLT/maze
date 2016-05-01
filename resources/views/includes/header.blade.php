<!DOCTYPE html>
<html lang="lt">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title')Maze - Žaidimų Bendruomenė | Žaidimų Forumas | Lietuviški Streamai</title>

		@yield('description')

		<link href='https://fonts.googleapis.com/css?family=Open+Sans:600,600italic,300,300italic,400,400italic,700,700italic,800,800italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
		<link href="{{ elixir("css/app.css") }}" rel="stylesheet">

		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		@if(Auth::check())
			<script type="text/javascript">
				var token = "{{ Auth::user()->secret }}";
				var auth_id = {{ Auth::user()->id }};
			</script>
		@endif
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container">
				<div class="row">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#maze-navbar-collapse" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="{{ route('page.index') }}"><img src="/images/logo.svg" alt="Logotipas" title="Eiti į pagrindinį"></a>
					</div>
					<div class="collapse navbar-collapse" id="maze-navbar-collapse">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="{{ route('page.index') }}">Forumas</a></li>
							<li><a href="{{ route('tv.index') }}">TV <span class="label maze-label label-diskusija">Beta</span></a></li>
							<li><a href="{{ route('search.index') }}">Paieška</a></li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
		<div id="the-content">