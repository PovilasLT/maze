
@if(!$reply->is_answer)
<div class="media post-show" id="pranesimas-{{ $reply->id }}">
@else
<div class="media post-show post-answer" id="pranesimas-{{ $reply->id }}">
@endif
  <div class="media-left media-top">
    <a href="{{ route('user.show', $reply->user->slug) }}">
    	<img class="media-object topic-avatar" src="{{ $reply->user->avatar }}" alt="{{ $reply->user->username }} Profilis">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading">
    	<a href="{{ route('user.show', $reply->user->slug) }}" class="author">{{ $reply->user->username }}</a>
    	<small class="date-when">{{ $reply->created_at }}</small>
		@if($topic->type == 2 && !$topic->is_answered)
			<small class="pull-right"><a href="{{ route('reply.answer', $reply->id) }}">Atsakymas</a></small>
    @elseif($topic->type == 2 && $topic->is_answered && $reply->is_answer)
      <span class="pull-right label label-success"><i class="fa fa-check-circle"></i> Atsakymas</span>
		@endif
    </h4>
    <div class="lightbox">
      {!! $reply->body !!}
    </div>
    @if(Auth::check() && (Auth::user()->can('manage_replies') || Auth::user()->id == $reply->user_id))
	  <div class="panel-footer text-right">
	  	<div class="btn-group" role="group" aria-label="...">
		  <a href="{{ route('reply.edit', $reply->id) }}"><button type="button" class="btn btn-xs btn-success">Redaguoti</button></a>
		  <a href="{{ route('reply.delete', $reply->id) }}"><button type="button" class="btn btn-xs btn-danger">Ištrinti</button></a>
		</div>
	  </div>
    @endif
  </div>
</div>