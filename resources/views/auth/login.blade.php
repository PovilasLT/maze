@extends('layouts.master')
@section('content')

<h2>Prisijungti</h2>

@include('auth.forms.login')

@stop

@section('sidebar')
	@include('includes.sidebar')
@stop