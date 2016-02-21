<li>
	<h4 class="media-heading">
		<a href="{{ route('topic.show', [$topic->slug]) }}">
			{{ $topic->title }}
		</a>
	</h4>
	<p class="topic-meta-container">
		<span class="media-meta-element">{!! $topic->nodePath() !!}</span>
	</p>
</li>