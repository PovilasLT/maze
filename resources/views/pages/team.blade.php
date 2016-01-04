@extends('layouts.master')

@section('description')
<meta name="description" content="Žmonės stumiantys Maze žaidimų bendruomenę ir forumą į priekį." />
@stop

@section('breadcrumbs')
	{!! Breadcrumbs::render('page.team') !!}
@stop

@section('title')
Komanda | @parent
@stop

@section('content')
	<h1>Maze Komanda</h1>
	<h2>Administratoriai</h2>
	<p><b><a href="/vartotojas/edvinas">Edvinas</a></b></p>
	<p><b><a href="/vartotojas/yiin">Yiin</a></b></p>
	<p><b><a href="/vartotojas/bebras">Bebras</a></b></p>
	<h2>Moderatoriai</h2>
	<p><b><a href="/vartotojas/codemenas">CodeMenas</a></b></p>
	<p><b><a href="/vartotojas/rin">Rin</a></b></p>
@stop

@section('sidebar')
	@include('includes.sidebar')
@stop