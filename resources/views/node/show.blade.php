@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('node.show', $node) !!}
@stop
@section('content')
	<ul class="nav nav-tabs">
	  <li role="presentation" @if($sort == 'populiariausi' || !$sort) class="active" @endif ><a href="?rodyti=populiariausi">Populiariausi</a></li>
	  <li role="presentation" @if($sort == 'naujausi') class="active" @endif ><a href="?rodyti=naujausi">Naujausi</a></li>
	</ul>
	@foreach($topics as $topic)
		@include('topic.item')
	@endforeach
	<div class="maze-pagination text-right">
		{!! $topics->appends(['rodyti' => $sort])->render() !!}
	</div>
@stop
@section('sidebar')
	@include('includes.sidebar')
@stop