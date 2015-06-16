@extends('layouts.master')
@section('breadcrumbs')
	{!! Breadcrumbs::render('topic.show', $topic) !!}
@stop
@section('content')
	<div class="media">
		<div class="votes pull-left">
			<div class="upvote-container">
				@if(!$topic->voted('up'))
				<i class="fa vote upvote"></i>
				@else
				<i class="fa vote upvote-active"></i>
				@endif
			</div>
			<div class="vote-count-container">
				@if($topic->vote_count > 0)
				<span class="positive">
					{{ $topic->vote_count }}
				</span>
				@elseif($topic->vote_count == 0)
				<span class="neutral">
					{{ $topic->vote_count }}
				</span>
				@else
				<span class="negative">
					{{ $topic->vote_count }}
				</span>
				@endif
			</div>
			<div class="downvote-container">
				@if(!$topic->voted('down'))
				<i class="fa vote downvote"></i>
				@else
				<i class="fa vote downvote-active"></i>
				@endif
			</div>
		</div>
		<div class="media-left media-top">
	    	<img class="media-object topic-avatar" src="https://placekitten.com/g/65/65" alt="Image">
		</div>
		<div class="media-body">
		<h1 class="media-heading">{{ $topic->title }}</h1>
		<p class="topic-meta">
		{!! $topic->full_type !!}
		@if($topic->is_blocked || $topic->order == 1 || $topic->pin_local)
		<span class="media-meta-element maze-label label-misc">
			@if($topic->is_blocked)
			<i class="fa fa-fw fa-lock"></i>
			@endif
			@if($topic->order == 1)
			<i class="fa fa-fw fa-bullhorn"></i>
			@endif
			@if($topic->pin_local)
			<i class="fa fa-fw fa-thumb-tack"></i>
			@endif
		</span>
		@endif
		<span class="media-meta-element">Autorius: <a href="/vartotojas/{{ $topic->user->slug }}">{{ $topic->user->username }}</a></span>
		<span class="media-meta-element">Parašyta: <strong><span class="date-when">{{ $topic->created_at }}</span></strong></span>
		<span class="media-meta-element">Pranešimų: <strong>{{ $topic->reply_count }}</strong></span>
		<span class="media-meta-element">Peržiūrų: <strong>{{ $topic->view_count }}</strong></span>
		</p>
	</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12 topic-content">
			{!! $topic->body !!}
		</div>
	</div>
	
	@if(!$topic->is_blocked)
		@include('reply.forms.create')
	@else
		<div class="alert alert-danger alert-generic" role="alert">Ši tema yra užrakinta!</div>
	@endif

	<div class="row">
		@include('topic.controls')
	</div>

	@foreach($topic->replies as $reply)
		@include('reply.show')
	@endforeach

@stop

@section('sidebar')
	@include('includes.sidebar_topic')
@stop