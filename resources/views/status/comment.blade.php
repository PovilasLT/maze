<div class="status-comment media" id="komentaras-{{ $comment->id }}">
	<a class="pull-left" href="{{ route('user.show', $comment->user->slug) }}">
		<img class="media-object avatar-object" src="{{ $comment->user->avatar }}" alt="{{ $comment->user->username }} Avataras">
	</a>
	<div class="media-body">
		<h4 class="media-heading">
		<a href="{{ route('user.show', $comment->user->slug) }}" class="author">{{ $comment->user->username }}</a>
		<small class="date-when">{{ $comment->created_at->diffForHumans() }}</small>
		</h4>
		{!! $comment->body !!}
	</div>
	@if(Auth::check() && (Auth::user()->id == $comment->user_id || Auth::user()->can('manage_statuses')))
		@include('status.comment_controls')
	@endif
</div>