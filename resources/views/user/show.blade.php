@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('user.show', $user) !!}
@stop

@section('content')
	<ul class="nav nav-tabs">
	  <li role="presentation"@if($sort == 'temos' || !$sort) class="active" @endif><a href="?rodyti=temos">Temos</a></li>
	  <li role="presentation"@if($sort == 'pranesimai') class="active" @endif><a href="?rodyti=pranesimai">Pranešimai</a></li>
	  <li role="presentation"@if($sort == 'busenos') class="active" @endif><a href="?rodyti=busenos">Būsenų atnaujinimai</a></li>
	</ul>
	<div class="notification-list">
		@foreach($items as $item)
			@include($item->view, [strtolower(class_basename($item)) => $item, 'votes' => false])
		@endforeach
	</div>
	<div class="maze-pagination text-right">
	@if(!$sort)
		{!! $items->render() !!}
	@else
		{!! $items->appends(['rodyti' => $sort])->render() !!}
	@endif
	</div>
	@include('conversation.create_popover', ['username' => $user->username])
@stop
@section('sidebar')
@include('includes.user_show_sidebar')
@stop