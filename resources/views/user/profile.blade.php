@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('user.profile') !!}
@stop

@section('content')
	@include('status.forms.create')
	<ul class="nav nav-tabs">
	  <li role="presentation"@if($sort == 'sekamieji' || !$sort) class="active" @endif><a href="?rodyti=sekamieji">Asmeniniai</a></li>
	  <li role="presentation"@if($sort == 'visi') class="active" @endif><a href="?rodyti=visi">Visi</a></li>
	</ul>
	@if(!$sort | $sort == 'sekamieji')
	<ul class="nav nav-pills filter">
	  <li role="presentation"><a href="?rodyti=sekamieji&sub=visi">Visi</a></li>
	  <li role="presentation"><a href="?rodyti=sekamieji&sub=paminejimai">Paminėjimai</a></li>
	  <li role="presentation"><a href="?rodyti=sekamieji&sub=temos">Temos</a></li>
	  <li role="presentation"><a href="?rodyti=sekamieji&sub=pranesimai">Pranešimai</a></li>
	  <li role="presentation"><a href="?rodyti=sekamieji&sub=busenos">Būsenų atnaujinimai</a></li>
	</ul>
	@endif
	<div class="notification-list">
		@foreach($items as $item)
			@include('notification.item')
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