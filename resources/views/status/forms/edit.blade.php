<div class="media markdown-form status-update-form">
	<a class="pull-left" href="#">
		<img class="media-object markdown-avatar" src="{{ $status->user->avatar }}" alt="{{ $status->user->username }} avataras">
	</a>
	<div class="media-body">
		<form action="{{ route('status.save') }}" method="POST" role="form">
		@include('includes.csrf')
		<input type="hidden" value="{{ $status->id }}" name="id">
			<div class="form-group">
				<textarea data-provide="markdown" name="body" id="inputBody" class="form-control" rows="1" required="required">{{ $status->body_original }}</textarea>
			</div>

			<button type="submit" class="btn btn-primary pull-right">Išsaugoti</button>
			<div class="clearfix"></div>
		</form>
	</div>
</div>