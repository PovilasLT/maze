@extends('layouts.master')


@section('title')
{{ $server->name . ' | ' . @parent }} 
@stop

@section('description')
<meta name="description" content="{{ str_limit(str_clean($server->body), 160, '...') }}">
@stop

@section('breadcrumbs')
	<div class='no-emojify'>
		{!! Breadcrumbs::render('server.show', $server) !!}
	</div>
@stop

@section('content')
	<div class="media topic-show topic-item-container">
		<div class="votes @if(Auth::check() && !Auth::user()->can_vote) votes-disabled @endif pull-left" id="votes-{{ $server->id }}">
			<div class="upvote-container vote-action" type="serveris" vote="upvote" id="{{ $server->id }}">
				@if(!$server->voted('up'))
				<i class="fa vote upvote"></i>
				@else
				<i class="fa vote upvote-active"></i>
				@endif
			</div>
			<div class="vote-count-container">
				@if($server->vote_count > 0)
				<span class="positive">
					{{ $server->vote_count }}
				</span>
				@elseif($server->vote_count == 0)
				<span class="neutral">
					{{ $server->vote_count }}
				</span>
				@else
				<span class="negative">
					{{ $server->vote_count }}
				</span>
				@endif
			</div>
			<div class="downvote-container vote-action" type="serveris" vote="downvote" id="{{ $server->id }}">
				@if(!$server->voted('down'))
					<i class="fa vote downvote"></i>
				@else
					<i class="fa vote downvote-active"></i>
				@endif
			</div>
		</div>
		<div class="media-left media-top">
		    <img class="media-object topic-avatar" src="{{ $server->logo }}" alt="{{ $server->name }}">
		</div>
		<div class="media-body">
		<h1 class="media-heading no-emojify">{{ $server->name }}</h1>
		<p class="topic-meta-container">
			<span class="media-meta-element" data-toggle="tooltip" data-placement="top" title="Tema Sukurta">
				<i class="fa fa-clock-o"></i>
				<span class="date-when">{{ $server->created_at->diffForHumans() }}</span>
			</span>
			<span class="media-meta-element" data-toggle="tooltip" data-placement="top" title="Temos Autorius">
				<i class="fa fa-user"></i> 
				<a class="author" href="{{ route('user.show', $server->user->slug) }}">{{ $server->user->username }}</a>
			</span>
		</p>
		<p>
			<span class="maze-label {{ $server->game->style_label }} media-meta-element">{{ $server->game->name }}</span></span>
			@if($server->is_blocked)
				<span class="media-meta-element maze-label label-misc">
					<i class="fa fa-fw fa-lock fa-fw" data-toggle="tooltip" title="Tema užrakinta"></i>
				</span>
			@endif
		</p>
	</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12 topic-content lightbox emojify">
			{!! $server->body !!}
			@include('server.controls')
		</div>
		@include('server.modals.delete')
	</div>


	@if(!$server->is_blocked)
		@if(Auth::check())
			@include('server_comment.forms.create')
		@else
			<div class="alert alert-warning alert-generic" role="alert">Norėdamas rašyti komentarą privalai <a href="{{ route('auth.login') }}">prisijungti</a> arba <a href="{{ route('auth.register') }}">užsiregistruoti</a>!</div>
		@endif
	@else
		<div class="alert alert-danger alert-generic margin-bottom text-center" role="alert">Šis serveris yra užrakinta!</div>
	@endif
	

	<div class="replies-wrapper">
	@if($server->comments->count())
		@foreach($server->comments as $comment)
			@include('server_comment.show')
		@endforeach
	@elseif(!$server->is_blocked)
		<p class="text-center">Šis serveris neturi komentarų! Būk pirmas!</p>
	@endif
	</div>

	<div class="reply-form-fix"></div>
@stop


@section('sidebar')
	@include('includes.server_sidebar')
@stop