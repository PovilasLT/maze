@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('reply.edit') !!}
@stop

@section('content')
	@include('reply.forms.edit')
@stop

@section('sidebar')
	@include('includes.sidebar')
@stop