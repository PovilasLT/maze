<form action="" method="POST" role="form">
	@include('includes.csrf')
	@foreach($topic->poll->answers as $answer)
		<label>{{ $answer->title }}</label>
		<div class="progress">
			<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $answer->percentage() }}%;">
				{{ $answer->votes()->count() }}	balsų ({{ $answer->percentage() }}%)
			</div>
		</div>
	@endforeach
	<button type="submit" class="btn btn-primary">Balsuoti</button>
</form>