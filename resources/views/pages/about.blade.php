@extends('layouts.master')

@section('description')
<meta name="description" content="Apie Maze žaidimų bendruomenę, forumą ir visą projektą. Vizija, misija ir tikslai." />
@stop

@section('breadcrumbs')
	{!! Breadcrumbs::render('page.about') !!}
@stop

@section('title')
Apie | @parent
@stop

@section('content')
	<h1>Apie Maze</h1>
	<h2>Kas yra Maze?</h2>
	<p>Maze apibrėžti kaip kažką konkretaus yra sunku. Maze yra būtybė, kurios tikslas yra suteikti "geimeriams" viską, ko  gali reikėti propaguojant šį pomėgį. Vienas iš projekto siekių yra išlaikyti kompiuterinių žaidimų žaidėjus įvykių centre, suteikti jiems sąlygas diskutuoti, tobulėti, įgyti naujus įgūdžius, mokytis ir mokyti kitus.</p>

	<p>Tuo pat metu siekia tobulėti ir Maze. Prisitaikyti prie savo auditorijos ir tobulėti kartu su savo lankytojais, suteikiant begalę įvairiausių įrankių "geiminimo" plėtrai ir vystymui.</p>

	<p>Projektas vadovaujasi "by gamers, for gamers" principu. Tai reiškia, kad už projekto vairo sėdi lygiai tokie pat kompiuterinių žaidimų fanatikai, kurie stebi ir bando nuspėti ko reikia bendruomenei ir kaip Maze viską gali pastūmėti į priekį.</p>
@stop

@section('sidebar')
	@include('includes.sidebar')
@stop