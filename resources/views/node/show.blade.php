@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('node.show', $node) !!}
@stop

@section('title')
@if($node->parent)
{{ $node->name . ' » ' . $node->parent->name . ' | ' }} 
@else
{{ $node->name . ' | ' }} 
@endif
@stop

@section('description')
<meta name="description" content="{{ str_limit(str_clean($node->description), 160, '...') }}">
@stop

@section('content')
	@include('includes.sort_tabs')
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