@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('search.results') !!}
@stop

@section('content')
	
	@foreach($results as $result)
		@if($type == 'user')
			@include('search.types.user')
		@elseif($type == 'reply')
			@include('search.types.reply')
		@elseif($type == 'topic')
			@include('search.types.topic')
		@elseif($type == 'status')
			@include('search.types.status')
		@endif
	@endforeach

	{!! $results->appends(['query' => $query, 'type' => $type])->render() !!}

@stop

@section('sidebar')
	@include('includes.sidebar')
@stop