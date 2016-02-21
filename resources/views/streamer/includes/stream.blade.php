<div class="row" id="stream">
	<div class="col-md-8 no-padding twitch-video">
		<div class="stream-container responsive-embed-wrapper">
			<iframe src="https://player.twitch.tv/?channel={{ $streamer->twitch }}" class="responsive-embed" frameborder="0" scrolling="no"></iframe>
		</div>
	</div>
	<div class="col-md-4 visible-md visible-lg no-padding twitch-chat">
		<iframe src="https://www.twitch.tv/{{ $streamer->twitch }}/chat?popout=" frameborder="0" scrolling="no" height="500" width="375"></iframe>
	</div>
</div>
<div class="row" id="stream-info">
	<div class="col-md-4 col-stream-meta">
		<div class="media">
			<a class="pull-left" href="#">
				<img class="media-object stream-avatar" src="{{ $streamer->logo }}">
			</a>
			<div class="media-body stream-info-body">
				<h2 class="media-heading">{{ $streamer->twitch }} <span class="label maze-label label-green"><i class="fa fa-gamepad"></i> {{ $streamer->game }}</span></h2>
				<p>{{ $streamer->status }}</p>
			</div>
		</div>
	</div>
	<div class="col-md-8 col-stream-meta">
		<div class="stream-meta">
			<a class="btn btn-success" target="_blank" href="http://twitch.tv/{{ $streamer->twitch }}" role="button"><i class="fa fa-twitch"></i> Twitch</a>
			@if($streamer->youtube)
			<a class="btn btn-success" target="_blank" href="{{ $streamer->youtube }}" role="button"><i class="fa fa-youtube-play"></i> YouTube</a>
			@endif
			@if($streamer->donate)
			<a class="btn btn-success" target="_blank" href="{{ $streamer->donate }}" role="button"><i class="fa fa-money"></i> Parama</a>
			@endif
			@if($streamer->facebook)
			<a class="btn btn-success" target="_blank" href="{{ $streamer->facebook }}" role="button"><i class="fa fa-facebook-official"></i> Facebook</a>
			@endif
			<span class="stream-stats hidden-sm hidden-xs">
				<i class="fa fa-user fa-green fa-stream-meta"></i> {{ number_format($streamer->current_viewers, 0) }}
				<i class="fa fa-eye fa-green fa-stream-meta"></i> {{ number_format($streamer->total_viewers, 0) }}
				<i class="fa fa-heart fa-green fa-stream-meta"></i> {{ number_format($streamer->total_followers, 0) }}
			</span>
		</div>
	</div>
</div>