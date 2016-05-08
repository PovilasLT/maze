<form action="{{ route('server.comment.update', [$comment->id]) }}" method="POST" role="form">
	@include('includes.csrf')
	<input type="hidden" name="comment_id" value="{{ $comment->id }}">
	<div class="form-group">
		<textarea data-provide="markdown" class="form-control" name="body" rows="5">{{ $comment->body_original }}</textarea>
	</div>
	<button type="submit" class="btn btn-primary">Išsaugoti</button>
</form>