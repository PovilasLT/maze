@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('user.profile') !!}
@stop

@section('content')
	@include('status.forms.create')
	<ul class="nav nav-tabs">
	  <li role="presentation"@if($sort == 'mano' || !$sort) class="active" @endif><a href="?rodyti=mano">Mano</a></li>
	  <li role="presentation"@if($sort == 'sekamieji') class="active" @endif><a href="?rodyti=sekamieji">Sekamieji</a></li>
	  <li role="presentation"@if($sort == 'busenos-atnaujinimai') class="active" @endif><a href="?rodyti=busenos-atnaujinimai">Visi Būsenų atnaujinimai</a></li>
	</ul>
	@if(!$sort | $sort == 'sekamieji' || $sort == 'mano')
	<ul class="nav nav-pills filter">
	  <li role="presentation"@if($subsort == "visi" || !$subsort) class='active' @endif><a href="?rodyti={{ $sort or 'mano' }}&subrodyti=visi">Visi</a></li>
	  <li role="presentation"@if($subsort == 'temos') class="active" @endif><a href="?rodyti={{ $sort or 'mano' }}&subrodyti=temos">Temos</a></li>
	  <li role="presentation"@if($subsort == 'pranesimai') class="active" @endif><a href="?rodyti={{ $sort or 'mano' }}&subrodyti=pranesimai">Pranešimai</a></li>
	  <li role="presentation"@if($subsort == 'busenos-atnaujinimai') class="active" @endif><a href="?rodyti={{ $sort or 'mano' }}&subrodyti=busenos-atnaujinimai">Būsenų atnaujinimai</a></li>
	  @if($sort != 'sekamieji')
	  <li role="presentation"@if($subsort == 'paminejimai') class="active" @endif><a href="?rodyti={{ $sort or 'mano' }}&subrodyti=paminejimai">Paminėjimai</a></li>
	  @endif
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