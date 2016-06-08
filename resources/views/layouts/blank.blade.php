<!DOCTYPE html>
<html lang="lt">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title') | Maze - Žaidimų Bendruomenė</title>

		<link href='https://fonts.googleapis.com/css?family=Open+Sans:600,600italic,300,300italic,400,400italic,700,700italic,800,800italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
		<link href="{{ elixir("css/app.css") }}" rel="stylesheet">

		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">
			@yield('content')
		</div>
		<div class="text-center brand-container">
			<a href="{{ route('page.index') }}">
				<img src="https://maze.lt/images/logo.svg" class="blank-brand-logo">				
			</a>
		</div>
	</body>
</html>