@extends('layouts.master')

@section('title')
{{ 'Klaida! | ' }}
@stop

@section('content')

	<h1>Oi! Kažkas ne taip...</h1>

	<p>Įvyko klaida mūsų pusėje. Ši klaida buvo užfiksuota ir galiausiai bus patikrinta administracijos. Jeigu klaida skubi ir manote, kad be greito pataisymo gyventi neįmanoma - informkuotie administraciją.</p>

@stop

@section('sidebar')
	@include('includes.sidebar')
@stop