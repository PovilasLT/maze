@if(!$reply->is_answer)
<div class="panel panel-default" id="pranesimas-{{ $reply->id }}">
@else
<div class="panel panel-success post-answer">
@endif
	  <div class="panel-heading">
			<h3 class="panel-title">
			{{ $reply->user->username }} 
			@if($topic->type == 2 && !$topic->is_answered)
			<small class="pull-right"><a href="{{ route('reply.answer', $reply->id) }}">Atsakymas</a></small>
			@endif
			</h3>
	  </div>
	  <div class="panel-body">
			{!! $reply->body !!}
	  </div>
	  @if(Auth::check() && (Auth::user()->can('manage_replies') || Auth::user()->id == $reply->user_id))
	  <div class="panel-footer">
	  	<div class="btn-group" role="group" aria-label="...">
		  <a href="{{ route('reply.edit', $reply->id) }}"><button type="button" class="btn btn-sm btn-success">Redaguoti</button></a>
		  <a href="{{ route('reply.delete', $reply->id) }}"><button type="button" class="btn btn-sm btn-danger">Ištrinti</button></a>
		</div>
	  </div>
	  @endif
</div>