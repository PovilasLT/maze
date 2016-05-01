<div class="topic-item topic-item-container media @if($topic->order == 1) global-pin @endif">
	<div class="votes @if(Auth::check() && !Auth::user()->can_vote) votes-disabled @endif pull-left" id="votes-{{ $topic->id }}">
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
	    <a href="{{ $topic->user->url }}"><img class="media-object topic-avatar" src="{{ $topic->user->avatar }}" alt="Avataras" data-toggle="tooltip" data-placement="right" title="{{ $topic->user->username }}" /></a>
	</div>
	<div class="media-body">
		<h4 class="media-heading">
			<a href="{{ route('topic.show', [$topic->slug]) }}" class='no-emojify'>
				{{ $topic->title }}
			</a>
		</h4>
		<p class="topic-meta-container">
			<span class="media-meta-element" data-toggle="tooltip" data-placement="top" title="Paskutinis atsakymas">
				<i class="fa fa-comment-o"></i> 
				@if(isset($topic->replies[0]))
				{{ $topic->replies[0]->created_at->diffForHumans() }}
				@else
				{{ $topic->created_at->diffForHumans() }}				
				@endif
			</span>
			<span class="media-meta-element" data-toggle="tooltip" data-placement="top" title="Paskutinio Atsakymo Autorius">
				<i class="fa fa-user"></i>
				@if(isset($topic->replies[0]))
				<a href="{{ $topic->replies[0]->user->url }}">{{ $topic->replies[0]->user->username }}</a>
				@else
				<a href="{{ $topic->user->url }}">{{ $topic->user->username }}</a>				
				@endif
			</span>
			<span class="media-meta-element" data-toggle="tooltip" data-placement="top" title="Viso Atsakymų">
				<i class="fa fa-comments-o"></i> 
				{{ $topic->reply_count }}
			</span>
		</p>
		<p class="topic-meta-container">
			<!-- {!! $topic->full_type !!} -->
			@if($topic->type != null)
				<span class="maze-label {{ $topic->type->label_style }} media-meta-element"><i class="{{ $topic->type->icon }}"></i><span class="hidden-xs">{{ $topic->type->name }}</span></span>
			@else
				<span class="maze-label label-diskusija media-meta-element"><i class="fa fa-comments-o fa-fw"></i><span class="hidden-xs">Diskusija</span></span>
			@endif
			@if($topic->is_blocked || $topic->order == 1 || $topic->pin_local)
			<span class="media-meta-element maze-label label-misc">
				@if($topic->is_blocked)
				<i class="fa fa-fw fa-lock fa-fw" data-toggle="tooltip" title="Tema užrakinta"></i>
				@endif
				@if($topic->order == 1)
				<i class="fa fa-fw fa-bullhorn fa-fw" data-toggle="tooltip" title="Tema prisegta globaliai"></i>
				@endif
				@if($topic->pin_local == 1)
				<i class="fa fa-fw fa-thumb-tack fa-fw" data-toggle="tooltip" title="Tema prisegta skiltyje"></i>
				@endif
			</span>
			@endif
			<span class="media-meta-element">{!! $topic->nodePath() !!}</span>
		</p>
	</div>
</div>
