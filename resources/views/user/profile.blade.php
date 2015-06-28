@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('home') !!}
@stop

@section('content')
	@include('status.forms.create')
	<ul class="nav nav-tabs">
	  <li role="presentation" ><a href="?rodyti=populiariausi">Sekamieji</a></li>
	  <li role="presentation" ><a href="?rodyti=naujausi">Visi</a></li>
	</ul>
	<ul class="nav nav-pills">
	  <li role="presentation"><a href="#">Visi</a></li>
	  <li role="presentation"><a href="#">Paminėjimai</a></li>
	  <li role="presentation"><a href="#">Temos</a></li>
	  <li role="presentation"><a href="#">Pranešimai</a></li>
	  <li role="presentation"><a href="#">Būsenų atnaujinimai</a></li>
	</ul>
	@foreach($items as $item)
		<div class="notification-show media">
			<a class="pull-left" href="#">
				<img class="media-object avatar-object" src="{{ $item->fromUser->avatar }}" alt="Image">
			</a>
			<div class="media-body">
			<h4 class="media-heading">
			<a href="{{ route('user.show', $item->fromUser->slug) }}" class="author">{{ $item->fromUser->username }}</a> @if($item->topic)<small>{!! $item->topic->nodePath() !!}</small>@endif
			</h4>
			@if($item->object_type != 'status_update')
				<p class="normal-body">{!! $item->notification !!}</p>
			@else

			@endif
			</div>
		</div>
	@endforeach

	<div class="maze-pagination text-right">
		{!! $items->render() !!}
	</div>
@stop
@section('sidebar')
	@include('includes.user_sidebar')
@stop