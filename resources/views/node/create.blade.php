@extends('layouts.master')

@section('title')
{{ 'Kurti naują skiltį | ' }}
@stop

@section('description')
<meta name="description" content="Neujos skilties kūrimas">
@stop

@section('content')

<h1>Kurti skiltį</h1>

@include('node.forms.create')

@stop

@section('sidebar')
	@include('includes.sidebar')
@stop