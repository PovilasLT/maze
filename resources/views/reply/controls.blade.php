<div class="pull-right text-right">
	<div class="btn-group" role="group" aria-label="...">
		<a href="#pranesimas-{{ $reply->id }}" class="pull-right btn btn-xs btn-grey"><button type="button" class="btn btn-xs btn-grey"><i class="fa fa-link"></i></button></a>
		@if(Auth::check() && (Auth::user()->can('manage_posts') || (Auth::user()->id == $reply->user_id) && !$reply->topic->is_blocked))
			<a href="{{ route('reply.edit', $reply->id) }}"><button type="button" class="btn btn-xs btn-grey"><i class="fa fa-pencil"></i></button></a>
			@if(Auth::user()->can('manage_topics') || $reply->user_id == Auth::user()->id)
	        <button type="button" class="btn btn-xs btn-grey" data-toggle="modal" data-target="#reply-confirm-delete-{{ $reply->id }}"><i class="fa fa-trash"></i></button>
	        @include('reply.modals.delete')
			@endif
		@endif
	</div>
</div>