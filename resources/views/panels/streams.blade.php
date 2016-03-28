<div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title"><i class="fa fa-fw fa-twitch"></i> Populiarūs Streamai</h4>
  </div>
  <div class="panel-body">
    <ul>
		@foreach(Streamer::getFrontPage() as $stream)
			<li>
				<a href="{{ route('streamer.show', e($stream->twitch)) }}">
				{{ $stream->twitch }}
				</a>
				@if($stream->is_online)
					<span class="pull-right" data-toggle="tooltip" data-placement="right" title="Dabar žiūri"><span class="label maze-label label-stream">{{ number_format($stream->current_viewers, 0) }}</span></span>
				@else
					<span class="pull-right" data-toggle="tooltip" data-placement="top" data-original-title="Nestreamina"><span class="label maze-label label-red"><i class="fa fa-eye-slash"></i></span></span>
				@endif
			</li>
	    @endforeach
	</ul>
	@if(Auth::check() && !Auth::user()->streamer)
		<a href="{{ route('settings.tv') }}" class="btn btn-success full-width">Streamink su Maze!</a>
	@endif
  </div>
</div>