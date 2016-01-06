<div class="media">
	<div class="media-left media-top">
		<a href="{{ $participant->url }}">
		    <img class="media-object topic-avatar" src="{{ $participant->avatar }}" alt="{{ $participant->username }}">
	    </a>
	</div>
	<div class="media-body">
		<h4 class="media-heading">
			<a href="{{ route('conversation.show', [$conversation->id]) }}">
				<small>
					@if(isset($conversation->messages[0]) && $conversation->pivot->read_at < $conversation->messages[0]->created_at)
						<span class="maze-label label-green media-meta-element"><i class="fa fa-comments"></i></span>
					@else
						<span class="maze-label label-grey media-meta-element"><i class="fa fa-comments-o"></i></span>
					@endif
				</small>
				{{ $participant->username }}
			</a>
		</h4>
		<p>
			<span class="media-meta-element">Pradėta: <strong>
			<span class="date-when">{{ $conversation->created_at }}</span></strong></span>
			<span class="media-meta-element">Paskutinė žinutė: <strong>
			<span class="date-when">{{ $conversation->updated_at }}</span></strong></span>
		</p>
	</div>
</div>