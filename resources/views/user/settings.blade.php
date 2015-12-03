@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('user.settings', $user, $user) !!}
@stop

@section('content')
	nustatymai
@stop

@section('sidebar')
	@include('includes.user_sidebar')
@stop