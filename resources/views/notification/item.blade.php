<div class="notification-show media">
	<a class="pull-left" href="{{ $item->fromUser->url }}">
		<img class="media-object avatar-object" src="{{ $item->fromUser->avatar }}" alt="Image">
	</a>
	<div class="media-body">
	<h4 class="media-heading">
	<a href="{{ $item->fromUser->url }}" class="author">{{ $item->fromUser->username }}</a>

	<small class="date-when">{{ $item->created_at->diffForHumans() }}</small>
	</h4>
		@if($item->object_type != 'Status')
		<p class="normal-body">{!! $item->notification !!}</p>
		@else
		{!! $item->object->body !!}
		@endif
	</div>
	@if($item->object_type == 'Status')
		@if(Auth::check())
			@include('status.controls', ['status' => $item->object])
		@endif
		<div class="status-comments" id="comments-{{ $item->object_id }}">
			@foreach($item->object->latestComments() as $comment)
				@include('status.comment')
			@endforeach
			@if($item->object->comments->count())
				<div class="text-center">
					<a href="{{ $item->url }}"><button class="btn btn-grey"><i class="fa fa-comments"></i> Visi Komentarai</button></a>
				</div>
			@endif
		</div>
	@else
		<div class="notification-filler">
		</div>
	@endif
</div>