<div class="panel panel-default" id="panel-nodes">
  <div class="panel-heading">
    <h3 class="panel-title">
      <i class="fa fa-comments-o fa-fw"></i> Būsenų Atnaujinimai
    </h3>
  </div>
  <div class="panel-body">
    @if(Auth::check())
    <a class="btn btn-success full-width update-status" href="{{ route('user.profile') }}">
      <i class="fa fa-pencil"></i> Atnaujinti Būseną
    </a>
    @endif
    @foreach(Status::getSidebarStatuses() as $status)
      <div class="media sidebar-status-item">
        <a class="pull-left" href="{{ $status->url }}">
          <img class="media-object small-avatar pull-left" src="{{ $status->user->avatar }}" alt="{{ $status->user->username }} Profilis">
        </a>
        <div class="media-body">
          <div class="media-heading sidebar-status-heading">
            <a href="{{ $status->url }}">{{ $status->user->username }}</a>
            <div class="pull-right sidebar-status-controls">
              <a data-toggle="tooltip" title="Komentarai" class="no-underline" href="{{ $status->url }}"><i class="fa fa-comments-o"></i> {{ $status->comment_count }}</a>
            </div>
          </div>
          {!! $status->body !!}
        </div>
      </div>
    @endforeach
    @if(Auth::check())
    <div class="row text-center">
      <div class="col-lg-12">
        <p><a href="{{ route('user.profile', ['rodyti' => 'visi']) }}">Rodyti Visus</a></p>
      </div>
    </div>
    @endif
  </div>
</div>