<form action="{{ route('topic.update', [$topic->id]) }}" method="POST" role="form">
@include('includes.csrf')
	<div class="form-group">
		<label for="node">Diskusijų Skiltis</label>
		<select name="node_id" id="node" class="form-control" required="required">
		@foreach($nodes as $node)
			<option value="" disabled>{{ $node->name }}</option>
			@foreach($node->children as $child)
			@if(($child->id != 15) || ($child->id == 15 && Auth::user()->can('manage_topics')))
				@if($topic->node_id == $child->id)
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
		<select name="type_id" id="type_id" class="form-control" required="required">
		@foreach($topic_types as $topic_type)
			@if(!$topic_type->is_admin || Auth::user()->can('manage_topics'))
				<option value="{{ $topic_type->id }}" @if($topic->type->id == $topic_type->id) selected="1" @endif>{{ $topic_type->name }}</option>
			@endif
		@endforeach
		</select>
	</div>
	<label for="title">Temos pavadinimas</label>
	<div class="form-group">
		<input type="text" name="title" id="title" class="form-control" value="{{ $topic->title }}" required="required">
	</div>
	<div class="form-group">
		<textarea  data-provide="markdown" class="form-control" name="body" value="{{ $topic->body_original }}" required>{{ $topic->body_original }}</textarea>
	</div>
	<button type="submit" class="btn btn-primary">Išsaugoti</button>
</form>