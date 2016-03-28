<form action="{{ route('node.store') }}" method="POST" role="form">
@include('includes.csrf')
	<div class="form-group">
		<label for="node">Diskusijų Skiltis</label>
		<select name="parent_node" id="parent_node" class="form-control" required="required">
			<option value='null'><b>-- Kategorija</b></option>
		@foreach($nodes as $node)
			<option value="{{ $node->id }}">-- {{ $node->name }}</option>
		@endforeach
		</select>
	</div>
	<label for="name">Skilties pavadinimas</label>
	<div class='form-group'>
		<input type='text' name='name' id='name' class='form-control' required="required">
	</div>
	<div class="form-group">
		<textarea tabindex="0" class="form-control" name="description" rows="10" placeholder="Aprašymas" required>{{ old('description') }}</textarea>
	</div>
	<button type='submit'>Įrašyti</button>
</form>