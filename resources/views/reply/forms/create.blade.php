<form action="{{ route('topic.store', ["slug" => $topic->slug]) }}" method="POST" role="form">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<legend>Rašyti naują pranešimą</legend>

	<div class="form-group">
		<textarea class="form-control" name="body" rows="3"></textarea>
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
</form>