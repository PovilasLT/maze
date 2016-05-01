@if($user->streamer)
	@if(!$user->streamer->is_online)
		<a href="{{ $user->streamer->url() }}" class="stream-offline" data-toggle="tooltip" title="Nestreamina"><i class="fa fa-twitch"></i></a>
	@else
		<a href="{{ $user->streamer->url() }}" class="stream-online" data-toggle="tooltip" title="{{ $user->streamer->current_viewers }}"><i class="fa fa-twitch"></i></a>
	@endif
@endif