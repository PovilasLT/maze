<form action="{{ route('reply.store') }}" method="POST" role="form">
@include('includes.csrf')
	<input type="hidden" name="topic_id" value="{{ $topic->id }}">
	<div class="form-group">
		<textarea data-provide="markdown" class="form-control" name="body" rows="1" placeholder="Čia rašyk savo išmintingo pranešimo turinį..." required></textarea>
	</div>

	<button type="submit" class="btn btn-primary pull-right">Rašyti</button>
	<div class="clearfix"></div>
</form>