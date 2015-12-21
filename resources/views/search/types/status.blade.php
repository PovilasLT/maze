<div class="media">
	<a class="pull-left" href="{{ route('status.show', $result->id) }}">
		<img class="media-object topic-avatar" src="{{ $result->user->avatar }}" alt="{{ $result->user->username }} Profilis">
	</a>
	<div class="media-body">
		<a href="{{ route('status.show', $result->id) }}">
			<h3 class="media-heading">{{ $result->user->username }}</h3>
		</a>
		<p>
			{!! $result->body !!}
		</p>
	</div>
</div>