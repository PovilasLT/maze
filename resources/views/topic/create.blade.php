@extends('layouts.master')
@section('breadcrumbs')
	{!! Breadcrumbs::render('topic.create') !!}
@stop

@section('title')
{{ 'Kurti naują temą | ' }}
@stop

@section('description')
<meta name="description" content="Neujos temos kūrimas">
@stop

@section('content')

<h1>Kurti temą</h1>

@include('topic.forms.create')

@stop

@section('sidebar')
	@include('includes.sidebar')
@stop