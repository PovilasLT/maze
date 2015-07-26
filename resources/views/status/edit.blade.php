@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('status.edit', $status) !!}
@stop

@section('content')
	<h1>Redaguoti būsenos atnaujinimą</h1>
	@include('status.forms.edit')
@stop

@section('sidebar')
	@include('includes.user_sidebar')
@stop