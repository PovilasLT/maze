@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('topic.edit', $topic) !!}
@stop

@section('content')
	<h2>Redaguoti temą: {{ $topic->title }}</h2>
	@include('topic.forms.edit')
@stop

@section('sidebar')
	@include('includes.sidebar')
@stop