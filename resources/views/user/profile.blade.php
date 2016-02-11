@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('user.profile') !!}
@stop

@section('content')
	@include('status.forms.create')
	<ul class="nav nav-tabs">
	  <li role="presentation"@if($sort == 'sekamieji' || !$sort) class="active" @endif><a href="?rodyti=sekamieji">Sekamieji</a></li>
	  <li role="presentation"@if($sort == 'visi') class="active" @endif><a href="?rodyti=visi">Būsenų atnaujinimai</a></li>
	</ul>
	@if(!$sort | $sort == 'sekamieji')
	<ul class="nav nav-pills filter">
	  <li role="presentation"><a href="?rodyti=sekamieji&subsort=visi">Visi</a></li>
	  <li role="presentation"><a href="?rodyti=sekamieji&subsort=paminejimai">Paminėjimai</a></li>
	  <li role="presentation"><a href="?rodyti=sekamieji&subsort=temos">Temos</a></li>
	  <li role="presentation"><a href="?rodyti=sekamieji&subsort=pranesimai">Pranešimai</a></li>
	  <li role="presentation"><a href="?rodyti=sekamieji&subsort=busenos">Būsenų atnaujinimai</a></li>
	</ul>
	@endif
	<div class="notification-list">
		@foreach($items as $item)
			@if(class_basename($item) == 'Status')
				@include('status.item', ['status' => $item])
			@else
				@include('notification.item')
			@endif
		@endforeach
	</div>
	<div class="maze-pagination text-right">
	@if(!$subsort)
		{!! $items->appends(['rodyti' => $sort])->render() !!}
	@else
		{!! $items->appends(['rodyti' => $sort, 'subsort' => $subsort])->render() !!}
	@endif
	</div>
@stop
@section('sidebar')
	@include('includes.user_sidebar')
@stop