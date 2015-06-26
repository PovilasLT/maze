@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('home') !!}
@stop

@section('content')
	@if(Auth::check() && Auth::user()->id == $user->id)
		
	@endif
	<ul class="nav nav-tabs">
	  <li role="presentation" ><a href="?rodyti=populiariausi">Sekamieji</a></li>
	  <li role="presentation" ><a href="?rodyti=naujausi">Visi</a></li>
	</ul>
	@foreach($items as $item)
		<div class="media">
			<a class="pull-left" href="#">
				<img class="media-object avatar-object" src="{{ $item->fromUser->avatar }}" alt="Image">
			</a>
			<div class="media-body">
			<h4>{{ $item->fromUser->username }}</h4>
			@if($item->object_type != 'status_update')
				<p class="normal-body">{!! $item->notification !!}</p>
			@else

			@endif
				<p>
					<span class="media-meta-element maze-label label-misc"><i class="fa {{ $item->icon }}"></i></span>
				@if($item->topic)
					<span class="media-meta-element">{!! $item->topic->nodePath() !!}</span>
					<span class="media-meta-element">Parašyta: <strong>
					<span class="date-when">{{ $item->topic->created_at }}</span></strong></span>
				@endif
				</p>
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