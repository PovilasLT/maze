@extends('layouts.master')
@section('content')

<h2>Prisijungti</h2>

@include('auth.forms.login')
<p>Pamiršai slaptažodį? <a href="{{ route('auth.reset.email') }}">Mes galime padėti!</a></p>

@stop

@section('sidebar')
	@include('includes.sidebar')
@stop