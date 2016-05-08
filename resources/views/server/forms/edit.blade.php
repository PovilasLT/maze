<form action="{{ route('server.update', [ $server->slug]) }}" method="POST" role="form" enctype="multipart/form-data">
@include('includes.csrf')

	<div class="form-group">
		<label for="game_id">Žaidimas</label>
		<select name="game_id" id="game_id" class="form-control" required="required">
		@foreach($game_types as $game_type)
			@if($server->game->id == $game_type->id)
				<option selected="selected" value="{{ $game_type->id }}">{{ $game_type->name }}</option>
			@else
				<option value="{{ $game_type->id }}">{{ $game_type->name }}</option>
			@endif
		@endforeach
		</select>
	</div>
	<div class='row'>
		<div class="col-md-6">
			<div class='row'>
				<div class='col-md-9'>
					<div class="form-group">
						<label for="ip">IP</label>
						<input tabindex="0" type="text" name="ip" id="ip" class="form-control" value="{{ $server->ip }}">
					</div>
				</div>
				<div class='col-md-3'>
					<div class="form-group">
						<label for="port">Port</label>
						<input tabindex="0" type="number" name="port" id="port" class="form-control" value="{{ $server->port }}">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="website">Svetainės adresas</label>
				<input tabindex="0" type="text" name="website" id="website" class="form-control" value="{{ $server->website }}">
			</div>
		</div>
	</div>
	<label for="name">Serverio pavadinimas</label>
	<div class="form-group">
		<input tabindex="0" type="text" name="name" id="name" class="form-control" value="{{ $server->name }}" required="required">
	</div>
	<div class="form-group">
		<textarea tabindex="0" data-provide="markdown" class="form-control" name="body" rows="10" required>{{ $server->body_original }}</textarea>
	</div>

	
	<label for="logo">Serverio logotipas</label>
	<div class="form-group">
		<input type="file" name="logo" id="logo">
	</div>
	Logotipo reikalavimai:
	<ul>
		<li>
			Tik <strong>.JPG</strong> ir <strong>.PNG</strong> formatas.
		</li>
		<li>
			Logotipai didesni nei <strong>150x150 px</strong> bus sumažinti iki atitinkamo dydžio.
		</li>
	</ul>


	@if(!Auth::user()->can('manage_topics') && Auth::user()->topic_count < 10)
	<div class="form-group">
		<label>Ar tu robotas?</label>
		{!! Recaptcha::render() !!}
	</div>
	@endif

	<button tabindex="0" type="submit" class="btn btn-primary">Rašyti</button>
</form>