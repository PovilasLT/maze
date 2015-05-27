@extends('layouts.master')
@section('content')
@foreach($topics as $topic)
	<a href="{!! route('topic.show', [$topic->slug]) !!}">{{ $topic->title }}</a><br>
@endforeach

	{!! $topics->render() !!}
@stop