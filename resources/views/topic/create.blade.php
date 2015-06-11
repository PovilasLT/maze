@extends('layouts.master')
@section('breadcrumbs')
	{!! Breadcrumbs::render('topic.create') !!}
@stop
@section('content')

<h1>Kurti temą</h1>

@include('topic.forms.create')

@stop

@section('sidebar')
	@include('includes.sidebar')
@stop