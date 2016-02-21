<div class="col-md-{{ $size or 3 }} stream-box-container">
	<div class="stream-bottom-info">
		<i class="fa fa-gamepad"></i> {{ $streamer->game }}
	</div>
	<div class="stream-box">
		@if($streamer->is_online)
			<span class="watch-now text-center"> <button class="btn btn-success">Žiūrėti</button> </span>
		@else
			<span class="watch-now text-center"> <button class="btn btn-danger">Nestreamina</button> </span>
		@endif
		<a href="{{ route('streamer.show', [$streamer->twitch]) }}"><img src="{{ $streamer->stream_image }}"></a>
	</div>
	<div class="stream-bottom-info">
		{{ $streamer->twitch }}
		@if($streamer->is_online)
			<span class="pull-right"><i class="fa fa-eye"></i> {{ number_format($streamer->current_viewers, 0) }}</span>
		@else
			<span class="pull-right"><i class="fa fa-eye-slash"></i></span>
		@endif
	</div>
</div>