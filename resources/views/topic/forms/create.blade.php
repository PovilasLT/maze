<form action="{{ route('topic.store') }}" method="POST" role="form">
@include('includes.csrf')
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="node">Diskusijų Skiltis</label>
				<select name="node_id" id="node" class="form-control" required="required">
				@foreach($nodes as $node)
					<option value="{{ $node->id }}">{{ $node->name }}</option>
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
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="type">Temos Tipas <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Temų tipai padeda kitiems lankytojams atskirti kokia tai tema. Kiekvienas temos tipas suteikia jūsų temai papildomas galimybes."></i></label>
				<select name="type_id" id="type_id" class="form-control" required="required">
				@foreach($topic_types as $topic_type)
					@if(!$topic_type->is_admin || Auth::user()->can('manage_topics'))
						<option value="{{ $topic_type->id }}">{{ $topic_type->name }}</option>
					@endif
				@endforeach
				</select>
			</div>
		</div>
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