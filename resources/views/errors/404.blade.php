@extends('layouts.master')

@section('title')
	{{ '404: Puslapis Nerastas | ' }}
@stop

@section('content')
	<div class="404-container text-center">
		<h1>Klaida 404: Puslapis Nerastas!</h1>
		<img src="/images/assets/404.png" alt="Puslapis Nerastas">
		<h2>GAME OVER</h2>
		<p>Atsiprašome, tačiau puslapis, kurio ieškote neegzistuoja.</p>
	</div>
@stop

@section('sidebar')
	@include('includes.sidebar')
@stop