@extends('layouts.tv')

@section('breadcrumbs')
	{!! Breadcrumbs::render('streamer.all') !!}
@stop

@section('title')
{{ 'Visos Transliacijos » Maze TV | ' }} 
@stop

@section('description')
<meta name="description" content="Lietuvos streamerių sąrašas ir gyvų žaidimų transliacijų vieta. Nerandi ką žiūrėti? Užeik!">
@stop

@section('content')
	<div class="row">
		<div class="col-sm-12 tv-heading"><h2>@if($current_game) {{ $current_game }} @else Visi @endif Streameriai</h2></div>
	</div>
	<div class="row">
		@foreach($streamers as $streamer)
			@include('streamer.includes.streambox', ['streamer' => $streamer, 'size' => 4])
		@endforeach
	</div>
	<div class="maze-pagination text-right">
		{!! $streamers->appends(['zaidimas' => $current_game])->render() !!}
	</div>
@stop