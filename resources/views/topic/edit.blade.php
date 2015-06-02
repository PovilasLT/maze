@extends('layouts.master')
@section('content')
	<h2>Redaguoti temą: {{ $topic->title }}</h2>
	@include('topic.forms.edit')
@stop