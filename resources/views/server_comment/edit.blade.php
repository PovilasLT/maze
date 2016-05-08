@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('server_comment.edit', $comment) !!}
@stop

@section('content')
	@include('server_comment.forms.edit')
@stop

@section('sidebar')
	@include('includes.sidebar')
@stop