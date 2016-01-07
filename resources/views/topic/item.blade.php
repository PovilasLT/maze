<div class="media">
	<div class="votes pull-left" id="votes-{{ $topic->id }}">
		<div class="upvote-container vote-action" type="tema" vote="upvote" id="{{ $topic->id }}">
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
		<div class="downvote-container vote-action" type="tema" vote="downvote" id="{{ $topic->id }}">
			@if(!$topic->voted('down'))
			<i class="fa vote downvote"></i>
			@else
			<i class="fa vote downvote-active"></i>
			@endif
		</div>
	</div>
	<div class="media-left media-top">
	    <a href="{{ $topic->user->url }}"><img class="media-object topic-avatar" src="{{ $topic->user->avatar }}" alt="{{ $topic->user->username }}"></a>
	</div>
	<div class="media-body">
		<h4 class="media-heading">
			<a href="{{ route('topic.show', [$topic->slug]) }}">
				{{ $topic->title }}
			</a>
		</h4>
		<p>
			<span class="media-meta-element" data-toggle="tooltip" data-placement="top" title="Parašyta">
				<i class="fa fa-clock-o"></i> 
				<span class="date-when">{{ $topic->created_at }}</span>
			</span>
			@if(isset($topic->replies[0]))
			<span class="media-meta-element" data-toggle="tooltip" data-placement="top" title="Paskutinis atsakymas">
				<i class="fa fa-comment-o"></i> 
				<span class="date-when">{{ $topic->replies[0]->created_at }}</span>
			</span>
			@endif
			<span class="media-meta-element" data-toggle="tooltip" data-placement="top" title="Atsakymų">
				<i class="fa fa-comments-o"></i> 
				{{ $topic->reply_count }}
			</span>
			<span class="media-meta-element" data-toggle="tooltip" data-placement="top" title="Peržiūrų">
			<i class="fa fa-eye"></i> 
			{{ $topic->view_count }}
			</span>
		</p>
		<p>
			{!! $topic->full_type !!}
			@if($topic->is_blocked || $topic->order == 1 || $topic->pin_local)
			<span class="media-meta-element maze-label label-misc">
				@if($topic->is_blocked)
				<i class="fa fa-fw fa-lock"></i>
				@endif
				@if($topic->order == 1)
				<i class="fa fa-fw fa-bullhorn"></i>
				@endif
				@if($topic->pin_local)
				<i class="fa fa-fw fa-thumb-tack"></i>
				@endif
			</span>
			@endif
			<span class="media-meta-element">{!! $topic->nodePath() !!}</span>
			<span class="media-meta-element" data-toggle="tooltip" data-placement="top" title="Temos autorius">
				<i class="fa fa-user"></i>
				<a href="{{ $topic->user->url }}">{{ $topic->user->username }}</a>
			</span>
			@if(isset($topic->replies[0]))
			<span class="media-meta-element"  data-toggle="tooltip" data-placement="top" title="Paskutinio atsakymo autorius">
				<i class="fa fa-users"></i>
				<a href="{{ $topic->replies[0]->user->url }}">{{ $topic->replies[0]->user->username }}</a>
			</span>
			@endif
		</p>
	</div>
</div>