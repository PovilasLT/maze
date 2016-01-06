@extends('layouts.master')

@section('title')
	{{ 'Slaptažodžio priminimas | '}}
@stop

@section('description')
	<meta name="description" content="Vartotojo slaptažodžio priminimas.">
@stop

@section('content')
	<h4>Slaptažodžio priminimas</h4>
	@include('auth.forms.password')
@stop

@section('sidebar')
	@include('includes.sidebar')
@stop