<div class="media markdown-form status-update-form">
	<a class="pull-left" href="{{ route('user.show', Auth::user()->slug) }}">
		<img class="media-object markdown-avatar" src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->username }} avataras">
	</a>
	<div class="media-body">
		<form action="{{ route('status.comment.create') }}" method="POST" role="form">
		@include('includes.csrf')
			<input type="hidden" name="status_id" value="{{ $status->id }}">
			<div class="form-group">
				<textarea data-provide="markdown" name="body" id="inputBody" class="form-control" rows="1" required="required" placeholder="Tavo protingas ir informatyvus komentaras..."></textarea>
			</div>
			<button type="submit" class="btn btn-primary pull-right">Rašyti</button>
			<div class="clearfix"></div>
		</form>
	</div>
</div>