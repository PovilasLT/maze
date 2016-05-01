@extends('layouts.messages')

@section('breadcrumbs')
	{!! Breadcrumbs::render('conversation.show', $conversation) !!}
@stop

@section('title')
{{  $receiver->username.' » Pokalbiai | '}} @parent
@stop

@section('content')
	<div class="row">
		<div class="col-md-3 hidden-xs hidden-sm" id="conversations">
			<button type="button" class="btn btn-success btn-block text-center" id="new-conversation"><i class="fa fa-plus"></i> Naujas Pokalbis</button>
			<ul class="participants">
				@foreach($conversations as $_conversation)
					@if(isset($_conversation->users[0]))
						@include('conversation.item', ['participant' => $_conversation->users[0], 'conversation' => $_conversation])
					@endif
				@endforeach
			</ul>
		</div>
		<div class="col-md-9 active-conversation" id="conversation" data-conversation-id="{{ $conversation->id }}">
			<button type="button" class="btn btn-success btn-block text-center visible-sm visible-xs" id="all-conversations"><i class="fa fa-comments"></i> Visi Pokalbiai</button>
			<div>
			</div>
			@include('message.forms.create')
			<div class="messages" id="messages-container">
				@foreach($messages as $message)
					@include('message.item', ['message' => $message])
				@endforeach
			</div>
			<div class="maze-pagination text-right">
				{!! $messages->render() !!}
			</div>
		</div>
	</div>
@stop