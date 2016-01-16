<form action="{{ route('topic.store') }}" method="POST" role="form">
@include('includes.csrf')
	<div class="form-group">
		<label for="node">Diskusijų Skiltis</label>
		<select name="node_id" id="node" class="form-control" required="required">
		@foreach($nodes as $node)
			<option value="" disabled>{{ $node->name }}</option>
			@foreach($node->children as $child)
			@if(($child->id != 15) || ($child->id == 15 && Auth::user()->can('manage_topics')))
				@if((old('node_id') == $child->id) || $node_id == $child->id)
				<option value="{{ $child->id }}" selected>-- {{ $child->name }}</option>
				@else
				<option value="{{ $child->id }}">-- {{ $child->name }}</option>
				@endif
			@endif
			@endforeach
		@endforeach
		</select>
	</div>
	<div class="form-group">
		<label for="type">Temos Tipas</label>
		<p class="helpblock">Temų tipai padeda kitiems lankytojams atskirti kokia tai tema. Kiekvienas temos tipas suteikia jūsų temai papildomas galimybes. <a href="{{ route('page.knowledgebase').'#temu-tipai' }}" target="_blank">[Skaityti Daugiau]</a></p>
		<select name="type" id="type" class="form-control" required="required">
			<option value="0">Diskusija</option>
			@if(Auth::user()->can('manage_topics'))
			<option value="215">Pranešimas</option>
			@endif
			<option value="2">Klausimas</option>
			<option value="3">Konkursas</option>
			<option value="4">Video</option>
			<option value="5">Stream</option>
			<option value="6">Kviečiu Žaisti</option>
			<option value="7">Pristatymas</option>
		</select>
	</div>
	<label for="title">Temos pavadinimas</label>
	<div class="form-group">
		<input tabindex="0" type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required="required">
	</div>
	<div class="form-group">
		<textarea tabindex="0" data-provide="markdown" class="form-control" name="body" rows="10" placeholder="Čia rašyk savo temos turinį..." required>{{ old('body') }}</textarea>
	</div>

	@if(!Auth::user()->can('manage_topic') && Auth::user()->topic_count < 10)
	<div class="form-group">
		<label>Ar tu robotas?</label>
		{!! Recaptcha::render() !!}
	</div>
	@endif

	<button tabindex="0" type="submit" class="btn btn-primary">Rašyti</button>
</form>