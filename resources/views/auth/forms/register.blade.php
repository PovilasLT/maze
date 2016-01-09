<form action="{{ route('auth.register.post') }}" method="POST" role="form">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<legend>Registruotis</legend>

	<div class="form-group">
		<label for="username">Vartotojo Vardas</label>
		<input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
		<p class="help-block">Galima naudoti tik raides, skaičius ir brūkšnius.</p>
	</div>

	<div class="form-group">
		<label for="email">El-paštas</label>
		<input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
	</div>

	<div class="form-group">
		<label for="password">Slaptažodis</label>
		<input type="password" class="form-control" id="password" name="password" required>
	</div>
	
	<div class="form-group">
		<label for="password_confirmation">Slaptažodžio Patvirtinimas</label>
		<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
	</div>

	<div class="form-group">
		<input type="checkbox" id="legal" name="legal" required>
		<label for="legal">Aš sutinku su taisyklėmis</label>
	</div>

	<div class="form-group">
		<label>Ar tu žmogus?</label>
		{!! Recaptcha::render() !!}
	</div>

	<button type="submit" class="btn btn-primary">Registruotis</button>
</form>