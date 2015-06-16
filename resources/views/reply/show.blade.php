
@if(!$reply->is_answer)
<div class="media post-show" id="pranesimas-{{ $reply->id }}">
@else
<div class="media post-show post-answer" id="pranesimas-{{ $reply->id }}">
@endif
  <div class="media-left media-top">
    <a href="#">
    	<img class="media-object topic-avatar" src="https://placekitten.com/g/65/65" alt="Image">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading">
    	<a href="#">{{ $reply->user->username }}</a>
    	<small class="date-when">{{ $reply->created_at }}</small>
		@if($topic->type == 2 && !$topic->is_answered)
			<small class="pull-right"><a href="{{ route('reply.answer', $reply->id) }}">Atsakymas</a></small>
		@endif
    </h4>
    {!! $reply->body !!}
    @if(Auth::check() && (Auth::user()->can('manage_replies') || Auth::user()->id == $reply->user_id))
	  <div class="panel-footer">
	  	<div class="btn-group" role="group" aria-label="...">
		  <a href="{{ route('reply.edit', $reply->id) }}"><button type="button" class="btn btn-xs btn-success">Redaguoti</button></a>
		  <a href="{{ route('reply.delete', $reply->id) }}"><button type="button" class="btn btn-xs btn-danger">Ištrinti</button></a>
		</div>
	  </div>
    @endif
  </div>
</div>