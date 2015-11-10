@if ($message->type === 'user_message')
	<li data-messageId="{{ $message->id }}" class="{{ $message->sender->id === Auth::user()->id ? 'confer-sent-message' : 'confer-received-message' }}">
		<img class="confer-user-avatar {{ $message->sender->id === Auth::user()->id ? 'confer-sent-avatar' : 'confer-received-avatar' }}" src="{{ url('/') . config('confer.avatar_dir') . $message->sender->avatar }}">
		<div class="confer-message-inner">
			<span class="confer-message-sender">{{ $message->sender->username }}</span>
			<span class="confer-message-body">{{{ $message->body }}}</span>
			<span class="confer-message-timestamp" data-timestamp="{{ $message->created_at->toDateTimeString() }}">{{ $message->created_at }}</span>
		</div>
	</li>
@else
	<li data-messageId="{{ $message->id }}" class="confer-conversation-message">
		<span>{!! $message->body !!}</span>
		<span class="confer-message-timestamp"	 data-timestamp="{{ $message->created_at->toDateTimeString() }}">{{ $message->created_at }}</span>
	</li>
@endif