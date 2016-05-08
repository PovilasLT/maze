<div class="pull-right text-right">
	<div class="btn-group" role="group" aria-label="...">
		<a href="#komentaras-{{ $comment->id }}" class="pull-right btn btn-xs btn-grey" data-toggle="tooltip" title="Nuoroda" data-placement="top"><button type="button" class="btn btn-xs btn-grey"><i class="fa fa-fw fa-link"></i></button></a>
		@if(Auth::check() && (Auth::user()->can('manage_posts') || (Auth::user()->id == $comment->user_id) && !$comment->server->is_blocked))
			<a href="{{ route('server.comment.edit', $comment->id) }}" data-toggle="tooltip" title="Redaguoti" data-placement="top"><button type="button" class="btn btn-xs btn-grey"><i class="fa fa-fw fa-pencil"></i></button></a>
			@if(Auth::user()->can('manage_topics') || $comment->user_id == Auth::user()->id)
				<button type="button" class="btn btn-xs btn-grey" data-toggle="modal" data-target="#comment-confirm-delete-{{ $comment->id }}" data-toggle="tooltip" title="Ištrinti" data-placement="top"><i class="fa fa-trash"></i></button>
				@include('server_comment.modals.delete')
			@endif
		@endif
	</div>
</div>