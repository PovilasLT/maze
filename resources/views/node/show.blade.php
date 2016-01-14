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
	<div class="row">
		<div class="col-md-9">
			@if($node->description)
			<p class="help-block">
				{{ $node->description }}
			</p>
			@endif
		</div>
		@if(Auth::check())
			@if($node->parent)
			<div class="col-md-3">
				<a href="{{ route('nodes.toggle', ['id' => $node->id]) }}" class="btn btn-success">
					<span class="glyphicon glyphicon-paperclip"></span>
					@if(in_array($node->id, Auth::user()->frontPageNodes()->toArray()))
						Nebesekti šios kategorijos
					@else
						Sekti šią kategoriją
					@endif
				</a>
			</div>
			@endif
		@endif
	</div>

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