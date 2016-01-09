@extends('layouts.master')
@section('breadcrumbs')
	{!! Breadcrumbs::render('topic.show', $topic) !!}
@stop

@section('title')
{{ $topic->title . ' » ' . $topic->node->parent->name . ' » ' . $topic->node->name . ' | ' }} 
@stop

@section('description')
<meta name="description" content="{{ str_limit(str_clean($topic->body), 160, '...') }}">
@stop

@section('content')
	<div class="media topic-show">
		<div class="votes @if(Auth::check() && !Auth::user()->can_vote) votes-disabled @endif pull-left" id="votes-{{ $topic->id }}">
			<div class="upvote-container vote-action" type="tema" vote="upvote" id="{{ $topic->id }}">
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
			<div class="downvote-container vote-action" type="tema" vote="downvote" id="{{ $topic->id }}">
				@if(!$topic->voted('down'))
					<i class="fa vote downvote"></i>
				@else
					<i class="fa vote downvote-active"></i>
				@endif
			</div>
		</div>
		<div class="media-left media-top">
			<a href="{{ route('user.show', $topic->user->slug) }}">
		    	<img class="media-object topic-avatar" src="{{ $topic->user->avatar }}" alt="{{ $topic->user->username }}">
	    	</a>
		</div>
		<div class="media-body">
		<h1 class="media-heading">{{ $topic->title }}</h1>
		<p>
			<span class="media-meta-element">Parašyta: <strong>
			<span class="date-when">{{ $topic->created_at->diffForHumans() }}</span></strong></span>
			<span class="media-meta-element">Pranešimų: <strong>{{ $topic->reply_count }}</strong></span>
			<span class="media-meta-element">Peržiūrų: <strong>{{ $topic->view_count }}</strong></span>
		</p>
		<p>
			{!! $topic->full_type !!}
			@if($topic->is_blocked || $topic->order == 1 || $topic->pin_local)
			<span class="media-meta-element maze-label label-misc">
				@if($topic->is_blocked)
				<i class="fa fa-fw fa-lock" data-toggle="tooltip" title="Tema yra užrakinta"></i>
  				@endif
  				@if($topic->order == 1)
				<i class="fa fa-fw fa-bullhorn" data-toggle="tooltip" title="Išskirta tema"></i>
  				@endif
  				@if($topic->pin_local)
				<i class="fa fa-fw fa-thumb-tack" data-toggle="tooltip" title="Prisegta tema"></i>
  				@endif
			</span>
			@endif
			<span class="media-meta-element">{!! $topic->nodePath() !!}</span>
			<span class="media-meta-element">Autorius: <a class="author" href="{{ route('user.show', $topic->user->slug) }}">{{ $topic->user->username }}</a> </span>
		</p>
	</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12 topic-content lightbox">
			{!! $topic->body !!}
			@include('topic.controls')
		</div>
	</div>
	
	@if(!$topic->is_blocked)
		@if(Auth::check())
			@include('reply.forms.create')
		@else
			<div class="alert alert-warning alert-generic" role="alert">Norėdamas rašyti pranešimą privalai <a href="{{ route('auth.login') }}">prisijungti</a> arba <a href="{{ route('auth.register') }}">užsiregistruoti</a>!</div>
		@endif
	@else
		<div class="alert alert-danger alert-generic margin-bottom text-center" role="alert">Ši tema yra užrakinta!</div>
	@endif
	
	<div class="replies-wrapper">
		@if($topic->replies->count())
			@foreach($topic->replies as $reply)
				@include('reply.show')
			@endforeach
		@elseif(!$topic->is_blocked)
			<p class="text-center">Šita tema neturi atsakymų! Būk pirmas!</p>
		@endif
	</div>

@stop

@section('sidebar')
	@include('includes.sidebar_topic')
@stop

@section('scripts')
<script type="text/javascript">
	// var create_reply_form = $('#create-reply-form');
	// if(create_reply_form.length)
	// {
	// 	create_reply_form.affix({
	// 		offset: create_reply_form.offset().top + create_reply_form.outerHeight()
	// 	});
	// 	$('.post-show:nth-child(n+2)')
	// 	.css('margin-top', 0 - create_reply_form.outerHeight())
	// 	.css('padding-top', create_reply_form.outerHeight());
	// }
</script>
@stop
