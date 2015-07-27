@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('status.show', $status) !!}
@stop

@section('content')
	<div class="row">
		<div class="col-lg-12 status-meta">
			Parašyta <span class="date-when">{{ $status->created_at }}</span>
			@if($status->editor && (Auth::user()->can('manage_statuses') || Auth::user()->id == $status->editor_id ))
			| Redagavo: <a href="{{ route('user.show', $status->editor->slug) }}">{{ $status->editor->username }}</a> (<span class="date-when">{{ $status->updated_at }}</span>)
			@endif
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 topic-content lightbox">
			{!! $status->body !!}
		</div>
	</div>
	@include('status.controls')
	<div class="status-comments display">
		@include('status.forms.comment.create')
		@foreach($status->comments as $comment)
			@include('status.comment')
		@endforeach
	</div>
@stop

@section('sidebar')
	@include('includes.user_sidebar')
@stop