<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">
      <i class="fa fa-gamepad fa-fw"></i> {{ $node->name }}
    </h3>
  </div>
  <div class="panel-body">
    @if(Auth::check())
        @if(in_array($node->id, Auth::user()->frontPageNodes()->toArray()))
          <a href="{{ route('nodes.toggle', ['id' => $node->id]) }}" class="btn btn-warning btn-block text-left">
          <i class="fa fa-bookmark fa-fw"></i> Nebeprenumeruoti <span class="pull-right"><i class="fa fa-question-circle" data-toggle="tooltip" title="Nutraukus skilties prenumeratą, temos esančios skiltyje nebebus matomos pagrindiniame puslapyje."></i></span>
          </a>
        @else
          <a href="{{ route('nodes.toggle', ['id' => $node->id]) }}" class="btn btn-success btn-block text-left">
          <i class="fa fa-bookmark fa-fw"></i> Prenumeruoti <span class="pull-right"><i class="fa fa-question-circle" data-toggle="tooltip" title="Užsiprenumeravus skiltį, skiltyje esančias temas matysite pagrindiniame puslapyje."></i></span>
          </a>
        @endif
    @endif

    <p class="single">{{ $node->description }}</p>

    <div class="row">
      <div class="col-xs-6 text-center">
        <strong>Viso Pranešimų</strong>
      </div>
      <div class="col-xs-6 text-center">
        <strong>Viso Temų</strong>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6 text-center stat">
        {{ $stats->replies }}
      </div>
      <div class="col-xs-6 text-center stat">
        {{ $stats->topics }}
      </div>
    </div>
  </div>
</div>