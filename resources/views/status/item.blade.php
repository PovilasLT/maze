<div class="status-show media">
	<a class="pull-left" href="{{ $status->user->url }}">
		<img class="media-object avatar-object" src="{{ $status->user->avatar }}" alt="Image">
	</a>
	<div class="media-body">
		<h4 class="media-heading">
			<a href="{{ $status->user->url }}" class="author">{{ $status->user->username }}</a>
			<small class="date-when">{{ $status->created_at->diffForHumans() }}</small>
			@if(Auth::check())
				@include('status.controls', ['status' => $status])
			@endif
		</h4>
		<div class="lightbox">
			{!! $status->body !!}
		</div>
		<div class="status-comments" id="comments-{{ $status->id }}">
			@foreach($status->latestComments() as $comment)
				@include('status.comment')
			@endforeach
			<div class="text-center">
				<a href="{{ $status->url }}"><button class="btn btn-grey"><i class="fa fa-comments"></i>{{ $status->comments->count() ? 'Visi Komentarai' : 'Komentarų nėra. Būk pirmas!' }}</button></a>
			</div>
		</div>
	</div>
</div>