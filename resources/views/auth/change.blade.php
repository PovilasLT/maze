@extends('layouts.master')
@section('content')

<h4>Slaptažodžio Keitimas</h4>

<form action="{{ route('auth.reset.post') }}" method="POST" role="form">
@include('')
	<legend>Form title</legend>

	<div class="form-group">
		<label for="">label</label>
		<input type="text" class="form-control" id="" placeholder="Input field">
	</div>

	

	<button type="submit" class="btn btn-primary">Submit</button>
</form>

@stop


@section('sidebar')
	@include('includes.sidebar')
@stop