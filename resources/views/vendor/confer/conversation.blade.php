<h2>
	@if ($conversation->isPrivate())
		{{ 'Asmeninis pokalbis su ' . $conversation->participants()->ignoreMe()->first()->username }}
	@elseif ($conversation->name)
		{{ $conversation->name }}
	@endif
</h2>
@if ( ! $conversation->isGlobal())
<div class="confer-conversation-options">
	<i class="fa fa-user-plus confer-invite-users"></i>
	@if ($conversation->participants->count() > 2)
	<i class="fa fa-sign-out confer-leave-conversation"></i>
	@endif
</div>
@endif
<div class="nano">
	<ul class="confer-conversation-message-list nano-content" data-conversationId="{{ $conversation->id }}">
		@if ( ! $messages->isEmpty() && $messages->count() > 4)
			<li class="load-more-messages">
				<span>Ankstesnės žinutės...</span>
			</li>
		@endif
		@foreach ($messages as $message)
			@include ('vendor.confer.message', ['message' => $message])
		@endforeach
	</ul>
</div>

{!! Form::open(['route' => ['confer.conversation.message.store', $conversation->id], 'class' => 'confer-new-message-form']) !!}
<div class="row">
	{!! Form::textarea('body', null, ['class' => 'col-xs-9 confer-new-message-input']) !!}
	{!! Form::submit('Siųsti', ['class' => 'col-xs-3 btn btn-primary new-message-submit-btn']) !!}
</div>
{!! Form::close() !!}