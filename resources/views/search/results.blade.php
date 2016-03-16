@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('search.results') !!}
@stop

@section('title')
{{ $query }} Paieškos Rezultatai | 
@stop

@section('content')
	
	@if(sizeof($results))
		@foreach($results as $result)
			@if($type == 'user')
				@include('search.types.user')
			@elseif($type == 'reply')
				@include('search.types.reply')
			@elseif($type == 'topic')
				@include('search.types.topic')
			@elseif($type == 'status')
				@include('search.types.status')
			@elseif($type == 'stream')
				@include('search.types.stream')
			@endif
		@endforeach
	@else
		<p class="text-center">Tavo paieškos užklausa neturi rezultatų :( <a href="{{ route('search.index') }}">Bandyk dar kartą.</a></p>
	@endif

	{!! $results->appends(['query' => $query, 'type' => $type])->render() !!}

@stop

@section('sidebar')
	@include('includes.sidebar')
@stop