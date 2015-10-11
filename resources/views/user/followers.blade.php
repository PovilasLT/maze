@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('user.followers', $user, $user) !!}
@stop

@section('content')
	<div class="row">
	@foreach($followers as $follower)
		<div class="col-sm-2 text-center">
			<img class="followers-avatar" src="{{ $follower->follower->avatar }}">
			<a href="{{ route('user.show', [$follower->follower->slug]) }}">{{ $follower->follower->username }}</a>
		</div>
	@endforeach
	</div>
	<div class="maze-pagination text-right">
		{!! $followers->render() !!}
	</div>
@stop

@section('sidebar')
@include('includes.user_show_sidebar')
@stop