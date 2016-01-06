@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('conversation.index') !!}
@stop

@section('title')
Pokalbiai | @parent
@stop

@section('content')

	<h4>Naujas Pokalbis</h4>
	@include('conversation.forms.create')

	<h4>Aktyvūs Pokalbiai</h4>
	@foreach($conversations as $conversation)
		@include('conversation.item', ['participant' => $conversation->users[0]])
	@endforeach
@stop

@section('sidebar')
	@include('includes.sidebar')
@stop