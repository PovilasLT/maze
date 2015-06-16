@extends('layouts.master')
@section('content')

<h4>Registracija</h4>

@include('auth.forms.register')

@stop


@section('sidebar')
	@include('includes.sidebar')
@stop