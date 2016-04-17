<div class="media markdown-form messenger-form" id="create-message-form">
	<div class="media-body">
		<form action="{{ route('conversation.store') }}" method="POST" role="form">
		@include('includes.csrf')
	
			<div class="form-group">
				<input type="text" name="username" id="inputUsername" class="form-control" value="{{ $username or old('username') }}" required="required" placeholder="Vartotojo vardas">
			</div>
			<div class="form-group">
				<textarea data-provide="markdown" class="form-control" name="body" rows="1" placeholder="Čia rašyk savo išmintingos žinutės turinį..." required>{{ old('body') }}</textarea>
			</div>

			<button type="submit" class="btn btn-primary pull-right">Siųsti <i class="fa fa-paper-plane-o"></i></button>
			<div class="clearfix"></div>
		</form>
	</div>
</div>