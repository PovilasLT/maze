@extends('layouts.master')
@section('breadcrumbs')
	{!! Breadcrumbs::render('home') !!}
@stop
@section('content')
	<ul class="nav nav-tabs">
	  <li role="presentation" class="active"><a href="#">Naujausi</a></li>
	  <li role="presentation"><a href="#">Populiariausi</a></li>
	</ul>
	@foreach($topics as $topic)
		@include('topic.item')
	@endforeach
	<div class="maze-pagination text-right">
		{!! $topics->render() !!}
	</div>
@stop

@section('sidebar')
	@include('includes.sidebar')
@stop