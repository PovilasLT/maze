<div class="row">
	<div class="col-lg-12 text-right">
		<button class="btn btn-grey show-status-comments" status-id="{{ $status->id }}"><i class="fa fa-comments-o"></i> Komentarų: {{ $status->comments->count() }}</button>
		<a href="{{ route('status.show', $status->id) }}"><button class="btn btn-grey"><i class="fa fa-link"></i></button></a>
		@if((Auth::user()->id == $status->user_id) || Auth::user()->can('manage_statuses'))
		<a href="{{ route('status.delete', $status->id) }}"><button class="btn btn-grey"><i class="fa fa-trash"></i></button></a>
		<a href="{{ route('status.edit', $status->id) }}"><button class="btn btn-grey"><i class="fa fa-pencil"></i></button></a>
		@endif
	</div>
</div>