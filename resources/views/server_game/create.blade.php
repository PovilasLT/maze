@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('servergame.create') !!}
@stop

@section('title')
{{ 'Kurti naują žaidimą | ' }}
@stop

@section('description')
<meta name="description" content="Naujo žaidimo sukūrimas">
@stop

@section('content')

<h1>žaidimo užregistravimas</h1>

@include('server_game.forms.create')

@stop

@section('sidebar')
	@include('includes.server_sidebar')
@stop