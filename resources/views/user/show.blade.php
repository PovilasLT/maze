@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('user.show', $user) !!}
@stop

@section('content')
	<ul class="nav nav-tabs">
	  <li role="presentation"@if($sort == 'visi' || !$sort) class="active" @endif><a href="?rodyti=visi">Visi</a></li>
	  <li role="presentation"@if($sort == 'temos') class="active" @endif><a href="?rodyti=temos">Temos</a></li>
	  <li role="presentation"@if($sort == 'pranesimai') class="active" @endif><a href="?rodyti=pranesimai">Pranešimai</a></li>
	  <li role="presentation"@if($sort == 'busenos') class="active" @endif><a href="?rodyti=busenos">Būsenų atnaujinimai</a></li>
	</ul>
	<div class="notification-list">
		@foreach($items as $item)
			@include('notification.item')
		@endforeach
	</div>
	<div class="maze-pagination text-right">
	@if(!$sort)
		{!! $items->render() !!}
	@else
		{!! $items->appends(['rodyti' => $sort])->render() !!}
	@endif
	</div>
@stop
@section('sidebar')
	@include('includes.user_sidebar')
@stop