<div class="media markdown-form messenger-form" id="create-message-form">
	<a class="pull-left" href="{{ route('user.show', Auth::user()->slug) }}">
		<img class="media-object markdown-avatar message-create-avatar" src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->username }} avataras">
	</a>
	<div class="media-body">
		<form action="{{ route('conversation.store') }}" method="POST" role="form">
		@include('includes.csrf')
	
			<div class="form-group">
				<input type="text" name="username" id="inputUsername" class="form-control" value="{{ $username or old('username') }}" required="required" placeholder="Vartotojo vardas">
			</div>
			<div class="form-group">
				<textarea class="form-control" name="body" rows="1" placeholder="Čia rašyk savo išmintingos žinutės turinį..." required>{{ old('body') }}</textarea>
			</div>

			<button type="submit" class="btn btn-primary pull-right">Rašyti</button>
			<div class="clearfix"></div>
		</form>
	</div>
</div>