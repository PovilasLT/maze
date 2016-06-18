@extends('layouts.master')

@section('title')
	{{ 'Prisijungimas per Steam | '}} 
@stop

@section('content')
	<h4>Prisijungimas per Steam</h4>
	<p>Norėdami tęsti turite įrašyti Jūsų būsimą vardą forume.</p>
	@include('auth.forms.steam')
@stop

@section('sidebar')
	@include('includes.sidebar')
@stop