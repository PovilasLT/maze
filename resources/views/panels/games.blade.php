<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">
      <i class="fa fa-gamepad fa-fw"></i> Streaminami Žaidimai
    </h3>
  </div>
  <div class="panel-body">
	<ul class="node-list">
      <li @if(!$current_game)) class="active-node" @endif>
        <i class="fa fa-circle-thin parent-icon"></i>
        <a href="{{ route('streamer.all') }}">
          Visi Streameriai
        </a>
      </li>
    @foreach($games as $game)
      @if($game)
      <li @if(strtolower($current_game) == strtolower($game)) class="active-node" @endif>
        <i class="fa fa-circle-thin parent-icon"></i>
        <a href="{{ route('streamer.all', ['zaidimas' => $game]) }}">
          {{ ucwords($game) }}
        </a>
      </li>
      @endif
    @endforeach
	</ul>
  </div>
</div>