@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('server.create') !!}
@stop

@section('title')
{{ 'Kurti naują serverį | ' }}
@stop

@section('description')
<meta name="description" content="Naujo serverio užregistravimas">
@stop

@section('content')

<h1>Serverio užregistravimas</h1>

@include('server.forms.create')

@stop

@section('sidebar')
	@include('includes.server_sidebar')
@stop