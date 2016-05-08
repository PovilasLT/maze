<form action="{{ route('servergame.store') }}" method="POST" role="form" enctype="multipart/form-data">
@include('includes.csrf')

	<div class='row'>
		<div class="col-md-6">
			<div class="form-group">
				<label for="name">Žaidimo Pavadinimas</label>
				<input tabindex="0" type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="style_label">Stiliaus etiketė<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Stiliaus etiketė tai yra CSS klasė kuri bus naudojama rodyti šį žaidimą."></i></label>
				<input tabindex="0" type="text" name="style_label" id="style_label" class="form-control" value="{{ old('style_label') }}">
			</div>
		</div>
	</div>
	
	<label for="default_logo">Numatytasis Žaidimo Logotipas</label>
	<div class="form-group">
		<input type="file" name="default_logo" id="default_logo">
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
	<button tabindex="0" type="submit" class="btn btn-primary">Rašyti</button>
</form>