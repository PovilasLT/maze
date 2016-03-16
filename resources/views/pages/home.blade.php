@extends('layouts.master')
@section('breadcrumbs')
	{!! Breadcrumbs::render('home') !!}
@stop

@section('description')
<meta name="description" content="Vienas didžiausių ir moderniausių žaidimų forumų Lietuvoje. Nori atrasti kažką naujo arba pasidalinti savo kūryba? Prisijunk!">
@stop

@section('content')
	@include('includes.sort_tabs')
	@foreach($topics as $topic)
		@include('topic.item')
	@endforeach
	<div class="maze-pagination text-right">
		{!! $topics->appends(['rodyti' => $sort])->render() !!}
	</div>
@stop

@section('sidebar')
	@include('includes.sidebar')
@stop