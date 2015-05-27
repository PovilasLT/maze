<form action="{{ route('topic.store') }}" method="POST" role="form">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="form-group">
		<label for="">label</label>
		<input type="text" class="form-control" id="" placeholder="Input field">
	</div>

	

	<button type="submit" class="btn btn-primary">Submit</button>
</form>