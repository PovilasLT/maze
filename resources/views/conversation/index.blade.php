@extends('layouts.messages')

@section('breadcrumbs')
	{!! Breadcrumbs::render('conversation.index') !!}
@stop

@section('title')
Pokalbiai | @parent
@stop

@section('content')
	<div class="row">
		<div class="col-md-3" id="conversations">
			<button type="button" class="btn btn-success btn-block text-center" id="new-conversation"><i class="fa fa-plus"></i> Naujas Pokalbis</button>
			<ul class="participants">
				@foreach($conversations as $conversation)
					@if(isset($conversation->users[0]))
						@include('conversation.item', ['participant' => $conversation->users[0]])
					@endif
				@endforeach
			</ul>
		</div>
		<div class="col-md-9 text-center hidden-xs hidden-sm" id="conversation">
			<h4>Aktyvaus pokalbio nėra :(</h4>
		</div>
	</div>
@stop

@section('sidebar')
	@include('includes.sidebar')
@stop