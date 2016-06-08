@extends('layouts.twitch')

@section('breadcrumbs')
	{!! Breadcrumbs::render('twitch.pages.index') !!}
@stop

@section('title')
Twitch | @parent
@stop

@section('content')
	@if(Auth::check() && !Auth::user()->streamer)
		<h3>Maze Twitch</h3>
		<div class="row">
			<div class="col-md-8">
				<p>
					Sveikas atvykęs!
				</p>
				<p>
					Maze Twitch yra visiškai <b>nemokamas</b>. Viskas ko mes norime iš tavęs - kad užsiregistruotum <a href="{{ route('tv.index') }}">Maze TV</a>.
				</p>
			</div>
			<div class="col-md-4">
				<a href="{{ route('settings.tv') }}" class="btn btn-lg btn-success full-width"><i class="fa fa-twitch fa-fw"></i> Prisijunk prie Maze TV!</a>
			</div>
		</div>
	@else
		2123
	@endif
@stop

@section('sidebar')
@stop