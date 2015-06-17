<form action="{{ route('reply.update', [$reply->id]) }}" method="POST" role="form">
	@include('includes.csrf')
	<input type="hidden" name="reply_id" value="{{ $reply->id }}">
	<div class="form-group">
		<textarea data-provide="markdown" class="form-control" name="body" rows="5">{{ $reply->body_original }}</textarea>
	</div>
	<button type="submit" class="btn btn-primary">Išsaugoti</button>
</form>