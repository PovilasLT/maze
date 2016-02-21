@extends('layouts.tv')
@section('breadcrumbs')
	{!! Breadcrumbs::render('tv.index') !!}
@stop

@section('title')
{{ 'Maze TV | ' }} 
@stop

@section('description')
<meta name="description" content="Lietuvos streamerių sąrašas ir gyvų žaidimų transliacijų vieta. Nerandi ką žiūrėti? Užeik!">
@stop

@section('content')
	@include('streamer.includes.stream', ['streamer' => $featured])
	<hr class="no-margin"></hr>
	<div class="row">
		<div class="col-sm-6 tv-heading"><h2>Aktyviausi Streamai</h2></div>
		<div class="col-sm-6 tv-heading tv-more">Daugiau streamų <a href="{{ route('streamer.all') }}" class="icon-square"><i class="fa fa-angle-double-right"></i></a></div>
	</div>
	<div class="row">
		@foreach($streamers as $streamer)
			@include('streamer.includes.streambox', ['streamer' => $streamer])
		@endforeach
	</div>
@stop