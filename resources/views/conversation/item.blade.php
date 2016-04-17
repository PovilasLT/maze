<a href="{{ route('conversation.show', [$conversation->id]) }}">
	<li>
		@if($participant->is_online)
			<i class="fa fa-circle fa-primary user-status" data-user-id="{{ $participant->id }}" data-toggle="tooltip" title="Prisijungęs"></i>
		@else
			<i class="fa fa-circle-o fa-grey user-status" data-user-id="{{ $participant->id }}" data-toggle="tooltip" title="Atsijungęs"></i>
		@endif
		{{ $participant->username }}
		<small class="pull-right" id="conversation-indicator-{{ $conversation->id }}">
		@if(isset($conversation->messages[0]) && $conversation->pivot->read_at < $conversation->messages[0]->created_at)
			<span data-toggle="tooltip" title="Yra naujų pranešimų"><i class="fa fa-comments fa-primary"></i></span>
		@else
			<span data-toggle="tooltip" title="Nėra naujų pranešimų"><i class="fa fa-comments-o fa-grey"></i></span>
		@endif
		</small>
	</li>
</a>