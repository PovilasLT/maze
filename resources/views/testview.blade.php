@extends('layouts.master')

@section('content')
<form action="{{ route('testgcm') }} " method='GET'>
	@include('includes.csrf')
	<input class='form-control' type='text' name='text' value="{{ old('text') }}" />
	<button type='submit' class='btn btn-success'>Siųsti</button>
</form>

@stop