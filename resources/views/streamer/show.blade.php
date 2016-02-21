@extends('layouts.tv')

@section('breadcrumbs')
	{!! Breadcrumbs::render('streamer.show', $streamer) !!}
@stop

@section('title')
{{ $streamer->twitch.' Transliacija » Maze TV | ' }} 
@stop

@section('description')
<meta name="description" content="{{ $streamer->twitch }} Twitch Transliacija.">
@stop

@section('content')
	@include('streamer.includes.stream', ['streamer' => $streamer])
	<hr class="no-margin">
	<div class="row">
		<div class="col-lg-12 tv-heading">
			<h2>Panašūs Streamai</h2>
		</div>
	</div>
	<div class="row">
	@foreach($related as $streamer)
		@include('streamer.includes.streambox', ['streamer' => $streamer])
	@endforeach
	</div>
@stop