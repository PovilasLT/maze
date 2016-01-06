<form action="{{ route('auth.reset.email.post') }}" method="POST" role="form">
    {!! csrf_field() !!}
	
	<div class="form-group">
		<label for="">El-Pašto Adresas</label>
		<input type="email" class="form-control" id="email" name="email">
	</div>
	

	<button type="submit" class="btn btn-primary">Priminti</button>
</form>