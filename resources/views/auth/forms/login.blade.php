<form action="{{ route('auth.login.post') }}" method="POST" role="form">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<legend>Prisijungti</legend>

	<div class="form-group">
		<label for="">Vartotojo Vardas</label>
		<input type="text" class="form-control" id="username" name="username">
	</div>
	
	<div class="form-group">
		<label for="">Slaptažodis</label>
		<input type="password" class="form-control" id="password" name="password">
	</div>
	

	<button type="submit" class="btn btn-primary">Prisijungti</button>
</form>