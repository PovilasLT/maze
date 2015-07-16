<div class="status-comment media">
	<a class="pull-left" href="#">
		<img class="media-object avatar-object" src="{{ $comment->user->avatar }}" alt="{{ $comment->user->username }} Avataras">
	</a>
	<div class="media-body">
		<h4 class="media-heading">
		<a href="{{ route('user.show', $comment->user->slug) }}" class="author">{{ $comment->user->username }}</a>
		<small class="date-when">{{ $comment->created_at }}</small>
		</h4>
		{!! $comment->body !!}
	</div>
	@if(Auth::user()->id == $comment->user_id || Auth::user()->can('manage_statuses'))
		@include('status.comment_controls')
	@endif
</div>