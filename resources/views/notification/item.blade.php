<div class="notification-show notification-item-{{ $item->id }} @if(!$item->is_read) notification-unread @endif media">
	<a class="pull-left" href="{{ $item->fromUser->url }}">
		<img class="media-object avatar-object" src="{{ $item->fromUser->avatar }}" alt="Image">
	</a>
	<div class="media-body">
	<h4 class="media-heading">
		<a href="{{ $item->fromUser->url }}" class="author">{{ $item->fromUser->username }}</a>
		<small class="date-when">{{ $item->created_at->diffForHumans() }}</small>
		@if(Auth::check() && $item->object_type == 'Status')
			@include('status.controls', ['status' => $item->object])
		@endif
		<span class="pull-right">
		@if(!$item->is_read)
			<span 
			class="like-link action-mark-read-notification" 
			data-id="{{ $item->id }}"
			data-toggle="tooltip" title="Žymėti Perskaitytą"
			><i class="fa fa-check"></i></span>
		@endif
		</span>
	</h4>
		@if($item->object_type != 'Status')
		<p class="normal-body">{!! $item->notification !!}</p>
		@else
		{!! $item->object->body !!}
		<div class="status-comments" id="comments-{{ $item->object_id }}">
			@foreach($item->object->latestComments() as $comment)
				@include('status.comment')
			@endforeach
			<div class="text-center">
				<a href="{{ $item->url }}"><button class="btn btn-grey"><i class="fa fa-comments"></i>{{ $item->object->comments->count() ? ' Visi Komentarai' : ' Komentarų nėra. Būk pirmas!' }}</button></a>
			</div>
		</div>
		@endif
	</div>
</div>