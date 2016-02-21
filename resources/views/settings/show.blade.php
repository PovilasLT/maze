@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('settings.'.$settings_page, $user, $user) !!}
@stop

@section('content')

	<ul class="nav nav-tabs">
	  <li role="presentation" @if(!isset($settings_page) || $settings_page == 'user') class="active" @endif ><a href="{{ route('settings.user') }}">Pagrindiniai</a></li>
	  <li role="presentation" @if($settings_page == 'tv') class="active" @endif><a href="{{ route('settings.tv') }}">TV</a></li>
	  <li role="presentation" @if($settings_page == 'password') class="active" @endif><a href="{{ route('settings.password') }}">Slaptažodis</a></li>
	</ul>

	@include('settings.'.$settings_page)

@stop

@section('sidebar')
	@include('includes.user_sidebar')
@stop