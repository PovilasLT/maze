<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">
      <i class="fa fa-trophy fa-fw"></i> Maze Rekomenduoja
    </h3>
  </div>
  <div class="panel-body">
  <ul class="node-list">
    @foreach(maze\Streamer::recommended()->get() as $stream)
      <li>
        <i class="fa fa-circle-thin parent-icon"></i>
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
  </div>
</div>