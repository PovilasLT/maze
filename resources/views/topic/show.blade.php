@extends('layouts.master')
@section('breadcrumbs')
	{!! Breadcrumbs::render('topic.show', $topic) !!}
@stop
@section('content')
	<h1>{{ $topic->title }} <small>{{ $topic->id }}</small></h1>
	
	<div class="row">
		<div class="col-lg-12">
			Autorius: {{ $topic->user->username }}
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12">
			{!! $topic->body !!}
		</div>
	</div>

	<div class="row">
		@include('topic.controls')
	</div>
	
	@if(!$topic->is_blocked)
		@include('reply.forms.create')
	@else
		<p class="text-danger">Tema užrakinta!</p>
	@endif

	@foreach($topic->replies as $reply)
		@include('reply.show')
	@endforeach

@stop

@section('sidebar')
	@include('includes.sidebar_topic')
@stop