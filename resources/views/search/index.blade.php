@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('search.index') !!}
@stop

@section('content')
	<h1>Paieška</h1>

	<form action="{{ route('search.results') }}" method="POST" role="form">
		
		@include('includes.csrf')

		<div class="radio">
			<label>
				<input type="radio" name="type" id="inputType" value="user" checked="checked">
				vartotojų
			</label>
		</div>

		<div class="radio">
			<label>
				<input type="radio" name="type" id="inputType" value="topic">
				temų
			</label>
		</div>

		<div class="radio">
			<label>
				<input type="radio" name="type" id="inputType" value="reply">
				pranešimų
			</label>
		</div>

		<div class="radio">
			<label>
				<input type="radio" name="type" id="inputType" value="status">
				būsenos atnaujinimų
			</label>
		</div>
	
		<div class="input-group">
			<input type="text" class="form-control" name="query" placeholder="Ieškomas turinys...">
			<span class="input-group-btn">
				<button class="btn btn-success" type="submit"><i class="fa fa-search"></i> Pirmyn!</button>
			</span>
		</div>
	
	</form>
@stop

@section('sidebar')
	@include('includes.sidebar')
@stop