@extends('layouts.master')
@section('content')

<h2>Keisti Vartotojo Vardą</h2>

<form action="{{ route('user.change.username') }}" method="POST" role="form">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<div class="form-group">
		<label for="">Vartotojo Vardas</label>
		<input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
	</div>

	<button type="submit" class="btn btn-primary">Keisti</button>
</form>

@stop

@section('sidebar')
	@include('includes.sidebar')
@stop