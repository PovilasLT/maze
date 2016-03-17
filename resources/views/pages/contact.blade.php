@extends('layouts.master')

@section('description')
<meta name="description" content="Susisiekti su maze administracija" />
@stop

@section('breadcrumbs')
	{!! Breadcrumbs::render('page.contact') !!}
@stop

@section('title')
Susisiekti | @parent
@stop

@section('content')
	<h1>Susisiekti</h1>
	<h2>Administratoriai</h2>
	<p><b><a href="/vartotojas/skepticalhippo1">Edvinas</a></b> - {{ HTML::obfuscate('edvinasrp@gmail.com') }}</p>
	<p><b><a href="/vartotojas/yiin4">Yiin</a></b> - {{ HTML::obfuscate('stanislovas.janonis@gmail.com') }}</p>
	<p><b><a href="/vartotojas/bebras3">Bebras</a></b> - {{ HTML::obfuscate('justas963@gmail.com') }}</p>
	<h2>Moderatoriai</h2>
	<p><b><a href="/vartotojas/codemenas12">CodeMenas</a></b> - {{ HTML::obfuscate('sauliusaulys@gmail.com') }}</p>
	<p><b><a href="/vartotojas/rin47">Rin</a></b> - {{ HTML::obfuscate('arnasswede@gmail.com') }}</p>
	<p><b><a href="/vartotojas/farwalker2755">Sheriff</a></b> - {{ HTML::obfuscate('saimon13@me.com') }}</p>
@stop

@section('sidebar')
	@include('includes.sidebar')
@stop
