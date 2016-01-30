<div class="panel-footer text-right">
	<div class="btn-group" role="group" aria-label="...">
		<a href="{{ route('reply.edit', $reply->id) }}"><button type="button" class="btn btn-xs btn-grey"><i class="fa fa-pencil"></i></button></a>
		@if(!Auth::user()->can('manage_topics') && !$topic->is_blocked())
		<a href="{{ route('reply.delete', $reply->id) }}"><button type="button" class="btn btn-xs btn-grey"><i class="fa fa-trash"></i></button></a>
		@endif
	</div>
</div>