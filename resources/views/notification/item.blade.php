<div class="notification-show media">
	<a class="pull-left" href="#">
		<img class="media-object avatar-object" src="{{ $item->fromUser->avatar }}" alt="Image">
	</a>
	<div class="media-body">
	<h4 class="media-heading">
	<a href="{{ route('user.show', $item->fromUser->slug) }}" class="author">{{ $item->fromUser->username }}</a>
	@if($item->topic)<small>{!! $item->topic->nodePath() !!}</small>
	@endif
	<small class="date-when">{{ $item->created_at }}</small>
	</h4>
		<p class="normal-body">{!! $item->notification !!}</p>
	</div>
	@if($item->object_type == 'status')
		@include('status.controls', ['status' => $item->object])
	@else
		<div class="notification-filler">
		</div>
	@endif
</div>