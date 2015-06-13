<div class="media">
	<div class="votes pull-left">
		<div class="upvote-container">
			@if(!$topic->voted('up'))
			<i class="fa vote upvote"></i>
			@else
			<i class="fa vote upvote-active"></i>
			@endif
		</div>
		<div class="vote-count-container">
			@if($topic->vote_count > 0)
			<span class="positive">
				{{ $topic->vote_count }}
			</span>
			@elseif($topic->vote_count == 0)
			<span class="neutral">
				{{ $topic->vote_count }}
			</span>
			@else
			<span class="negative">
				{{ $topic->vote_count }}
			</span>
			@endif
		</div>
		<div class="downvote-container">
			@if(!$topic->voted('down'))
			<i class="fa vote downvote"></i>
			@else
			<i class="fa vote downvote-active"></i>
			@endif
		</div>
	</div>
	<div class="media-left media-top">
	    <img class="media-object topic-avatar" src="https://placekitten.com/g/65/65" alt="Image">
	</div>
	<div class="media-body">
		<h4 class="media-heading"><a href="{{ route('topic.show', [$topic->slug]) }}">
		@if($topic->is_blocked)
		<i class="fa fa-lock"></i>
		@endif
		{{ $topic->title }}
		</a></h4>

		<p><span class="media-meta-element">Parašyta: <strong><span class="date-when">{{ $topic->created_at }}</span></strong></span><span class="media-meta-element">Pranešimų: <strong>{{ $topic->reply_count }}</strong></span> <span class="media-meta-element">Peržiūrų: <strong>{{ $topic->view_count }}</strong></span></p>

		<p>
		{!! $topic->full_type !!} <span class="media-meta-element">{!! $topic->nodePath() !!}</span> <span class="media-meta-element">Autorius: <a href="/vartotojas/{{ $topic->user->slug }}">{{ $topic->user->username }}</a> </span></p>
	</div>
</div>