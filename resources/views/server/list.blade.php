@extends('layouts.master')



@section('description')
<meta name="description" content="Vienas didžiausių ir moderniausių žaidimų forumų Lietuvoje. Nori atrasti kažką naujo arba pasidalinti savo kūryba? Prisijunk!">
@stop

@section('breadcrumbs')
	<div class='no-emojify'>
		{!! Breadcrumbs::render('server.list', $game) !!}
	</div>
@stop

@section('content')
	<ul class="nav nav-tabs">
	  <li role="presentation"@if($tab == 'naujausi' || !$tab) class="active" @endif><a href="?rodyti=naujausi&zaidimas={{$game}}">Naujausi</a></li>
	  <li role="presentation"@if($tab == 'populiariausi') class="active" @endif><a href="?rodyti=populiariausi&zaidimas={{$game}}">Populiariausi</a></li>
	</ul>
	@foreach($servers as $server)
		@include('server.item')
	@endforeach
	<div class="maze-pagination text-right">
		{!! $servers->appends(['rodyti' => $tab])->render() !!}
	</div>
@stop

@section('sidebar')
	@include('includes.server_sidebar')
@stop