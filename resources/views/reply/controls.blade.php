<div class="pull-right text-right">
	<div class="btn-group" role="group" aria-label="...">
		<a href="#pranesimas-{{ $reply->id }}" class="pull-right btn btn-xs btn-grey" data-toggle="tooltip" title="Nuoroda" data-placement="top"><button type="button" class="btn btn-xs btn-grey"><i class="fa fa-fw fa-link"></i></button></a>
		@if(Auth::check() && (Auth::user()->can('manage_posts') || (Auth::user()->id == $reply->user_id) && !$reply->topic->is_blocked))
			<a href="{{ route('reply.edit', $reply->id) }}" data-toggle="tooltip" title="Redaguoti" data-placement="top"><button type="button" class="btn btn-xs btn-grey"><i class="fa fa-fw fa-pencil"></i></button></a>
			@if(Auth::user()->can('manage_topics') || $reply->user_id == Auth::user()->id)
			<a href="{{ route('reply.delete', $reply->id) }}" data-toggle="tooltip" title="Ištrinti" data-placement="top"><button type="button" class="btn btn-xs btn-grey"><i class="fa fa-fw fa-trash"></i></button></a>
			@endif
		@endif
	</div>
</div>