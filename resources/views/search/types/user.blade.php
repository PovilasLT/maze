<div class="media">
	<a class="pull-left" href="{{ route('user.show', $result->slug) }}">
		<img class="media-object topic-avatar" src="{{ $result->avatar }}" alt="{{ $result->username }} Profilis">
	</a>
	<div class="media-body">
		<a href="{{ route('user.show', $result->slug) }}"><h3 class="media-heading">{{ $result->username }}</h3></a>
		<p>
			<b>Rangas:</b> {{ $result->role }} | <b>Apie:</b> {{ $result->about_me or 'Informacijos Nėra!' }}
		</p>
	</div>
</div>