@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('status.comment.edit', $comment) !!}
@stop

@section('content')
	<h1>Redaguoti būsenos komentarą</h1>
	@include('status.forms.comment.edit')
@stop

@section('sidebar')
	@include('includes.user_sidebar')
@stop