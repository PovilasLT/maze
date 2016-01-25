<div class="create-form-wrapper">
	<div class="media markdown-form" id="create-reply-form">
		<a class="pull-left" href="{{ route('user.show', Auth::user()->slug) }}">
			<img class="media-object markdown-avatar" src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->username }} avataras">
		</a>
		<div class="media-body">
			<form action="{{ route('reply.store') }}" method="POST" role="form">
			@include('includes.csrf')
				<input type="hidden" name="topic_id" value="{{ $topic->id }}">
				<div class="form-group">
					<textarea data-provide="markdown" class="form-control" name="body" rows="1" placeholder="Čia rašyk savo išmintingo pranešimo turinį..." required>{{ old('body') }}</textarea>
				</div>

				<button type="submit" class="btn btn-primary pull-right">Rašyti</button>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
</div>