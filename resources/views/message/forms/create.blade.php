<div class="media markdown-form messenger-form" id="create-message-form">
	<a class="pull-left" href="{{ route('user.show', Auth::user()->slug) }}">
		<img class="media-object markdown-avatar" src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->username }} avataras">
	</a>
	<div class="media-body">
		<form action="{{ route('message.store') }}" method="POST" role="form" id="send-message">
			@include('includes.csrf')
			<input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
			<div class="form-group">
				<textarea data-provide="markdown" class="form-control" name="body" rows="1" placeholder="Čia rašyk savo išmintingos žinutės turinį..." required></textarea>
			</div>
			<button type="submit" class="btn btn-success pull-right">Siųsti <i class="fa fa-paper-plane-o"></i></button>
			<div class="clearfix"></div>
		</form>
	</div>
</div>