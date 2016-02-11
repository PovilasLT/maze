<div class="panel panel-default" id="panel-nodes">
  <div class="panel-heading">
    <h3 class="panel-title">
      <i class="fa fa-twitch"></i> Dabar Streamina
    </h3>
  </div>
  <div class="panel-body">
    skldjf
  </div>
</div>
<div class="panel panel-default" id="panel-nodes">
  <div class="panel-heading">
    <h3 class="panel-title">
      Būsenų Atnaujinimai
    </h3>
  </div>
  <div class="panel-body">
    <button class="btn btn-success full-width update-status">
      <i class="fa fa-pencil"></i> Atnaujinti Būseną
    </button>
    @foreach( as $status)
      <div class="sidebar-status">
        <img class="media-object status-avatar pull-left" src="{{ $status->user->avatar }}" alt="{{ $status->user->username }} Profilis">
        <a href="{{ $status->user->url }}">{{ $status->user->username }}</a>
        <div class="clearfix"></div>
        <div class="sidebar-status-body">
          {!! $status->body !!}
        </div>
      </div>
    @endforeach
  </div>
</div>