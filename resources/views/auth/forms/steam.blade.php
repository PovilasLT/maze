<form action="{{ route('auth.login.steam.post') }}" method="POST" role="form">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="steamid" value="{{ $info->getSteamID64() }}">
<input type="hidden" name="ref" value="{{ \URL::previous() }}"></input>
	<div class="form-group">
		<label for="username">Vartotojo Vardas</label>
		<input type="text" class="form-control" id="username" name="username" required>
		<p class="help-block">Galima naudoti tik raides, skaičius ir brūkšnius.</p>
	</div>

	<div class="form-group">
		<label for="email">El-paštas</label>
		<input type="email" class="form-control" id="email" name="email" required>
	</div>

	<button type="submit" class="btn btn-primary">Tęsti</button>
</form>