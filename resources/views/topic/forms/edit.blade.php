<form action="{{ route('topic.update', [$topic->id]) }}" method="POST" role="form">
@include('includes.csrf')
	<div class="form-group">
		<label for="node">Diskusijų Skiltis</label>
		<select name="node_id" id="node" class="form-control" required="required">
		@foreach($nodes as $node)
			<option value="" disabled>{{ $node->name }}</option>
			@foreach($node->children as $child)
				@if(old('node_id') == $child->id)
				<option value="{{ $child->id }}" selected>{{ $child->name }}</option>
				@else
				<option value="{{ $child->id }}">{{ $child->name }}</option>
				@endif
			@endforeach
		@endforeach
		</select>
	</div>
	<label for="title">Temos pavadinimas</label>
	<div class="form-group">
		<input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required="required">
	</div>
	<div class="form-group">
		<textarea class="form-control" name="body" required>{{ old('body') }}</textarea>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>