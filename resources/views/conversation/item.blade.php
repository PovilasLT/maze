<div class="media">
	<div class="media-left media-top">
	    <img class="media-object topic-avatar" src="{{ $participant->avatar }}" alt="{{ $participant->username }}">
	</div>
	<div class="media-body">
		<h4 class="media-heading">
			<a href="{{ route('conversation.show', [$conversation->id]) }}">
				{{ $participant->username }}
			</a>
		</h4>
		<p>
			<span class="media-meta-element">Pradėta: <strong>
			<span class="date-when">{{ $conversation->created_at }}</span></strong></span>
			<span class="media-meta-element">Paskutinė žinutė: <strong>
			<span class="date-when">{{ $conversation->updated_at }}</span></strong></span>
		</p>
		<p>
			<span class="media-meta-element">Viso žinučių: <strong>{{ $conversation->messages()->count() }}</strong></span>
		</p>
	</div>
</div>