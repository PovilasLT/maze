@extends('layouts.master')

@section('description')
<meta name="description" content="Susisiekti su maze administracija" />
@stop

@section('breadcrumbs')
	{!! Breadcrumbs::render('page.contact') !!}
@stop

@section('title')
Susisiekti | @parent
@stop

@section('content')
	<h1>Susisiekti</h1>
	<h2>Administratoriai</h2>
	<p><b><a href="/vartotojas/edvinas">Edvinas</a></b> - edvinasrp@gmail.com</p>
	<p><b><a href="/vartotojas/yiin">Yiin</a></b> - stanislovas.janonis@gmail.com</p>
	<p><b><a href="/vartotojas/bebras">Bebras</a></b> - [...]</p>
	<h2>Moderatoriai</h2>
	<p><b><a href="/vartotojas/codemenas">CodeMenas</a></b> - [...]</p>
	<p><b><a href="/vartotojas/rin">Rin</a></b> - [...]</p>
@stop

@section('sidebar')
	@include('includes.sidebar')
@stop