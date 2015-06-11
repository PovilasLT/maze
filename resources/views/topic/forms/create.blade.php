<form action="{{ route('topic.store') }}" method="POST" role="form">
@include('includes.csrf')
	<div class="form-group">
		<label for="node">Diskusijų Skiltis</label>
		<select name="node_id" id="node" class="form-control" required="required">
		@foreach($nodes as $node)
			<option value="" disabled>{{ $node->name }}</option>
			@foreach($node->children as $child)
			@if(($child->id != 15) || ($child->id == 15 && Auth::user()->can('manage_topics')))
				@if(old('node_id') == $child->id)
				<option value="{{ $child->id }}" selected>-- {{ $child->name }}</option>
				@else
				<option value="{{ $child->id }}">-- {{ $child->name }}</option>
				@endif
			@endif
			@endforeach
		@endforeach
		</select>
		<label for="type">Temos Tipas</label>
		<p class="helpblock">Temų tipai padeda kitiems lankytojams atskirti kokia tai tema. Kiekvienas temos tipas suteikia jūsų temai papildomas galimybes. <a href="#" target="_blank">[Skaityti Daugiau]</a></p>
		<select name="type" id="type" class="form-control" required="required">
			<option value="0">Diskusija</option>
			@if(Auth::user()->can('manage_topics'))
			<option value="215">Pranešimas</option>
			@endif
			<option value="2">Klausimas</option>
			<option value="3">Apklausa</option>
		</select>
	</div>
	<label for="title">Temos pavadinimas</label>
	<div class="form-group">
		<input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required="required">
	</div>
	<div class="form-group">
		<textarea data-provide="markdown" class="form-control" name="body" rows="10" required>{{ old('body') }}</textarea>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>