<form action="{{ route('auth.forgot.post') }}" method="POST" role="form">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<div class="form-group">
		<label for="">Vartotojo Vardas</label>
		<input type="text" class="form-control" id="username" name="username">
	</div>
	
	<div class="form-group">
		<label for="">El-Pašto Adresas</label>
		<input type="email" class="form-control" id="email" name="email">
	</div>
	

	<button type="submit" class="btn btn-primary">Priminti</button>
</form>