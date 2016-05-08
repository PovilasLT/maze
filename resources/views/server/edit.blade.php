@extends('layouts.master')

@section('breadcrumbs')
	<div class='no-emojify'>
		{!! Breadcrumbs::render('server.edit', $server) !!}
	</div>
@stop

@section('content')
	<h2>Redaguoti serverį: {{ $server->name }}</h2>
	@include('server.forms.edit')
@stop

@section('sidebar')
	@include('includes.sidebar')
@stop