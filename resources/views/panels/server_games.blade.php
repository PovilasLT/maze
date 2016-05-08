<div class="panel panel-default" id="panel-nodes">
  <div class="panel-heading">
    <h3 class="panel-title">
      <i class="fa fa-bars fa-fw"></i> Serverių Tipai
      @if(Auth::check() && Auth::user()->can('manage_nodes'))
        <a href="{{ route('servergame.create') }}">
          <i class="fa fa-plus pull-right"></i>
        </a>
      @endif
    </h3>
  </div>
  <div class="panel-body">
	<ul class="node-list">
    @foreach(maze\ServerGame::get() as $game)
      <li class='is-expanded'>
          <i class="fa fa-plus parent-icon" id="{{ $game->id }}"></i>
          <a href="{{ route('server.list', ['zaidimas' => $game->slug]) }}">{{ $game->name }}</a>
      </li>
    @endforeach
	</ul>
  </div>
</div>