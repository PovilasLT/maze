<div class="server-item topic-server-container media @if(!$server->is_confirmed) server-unconfirmed @endif">
	<div class="votes @if(Auth::check() && !Auth::user()->can_vote) votes-disabled @endif pull-left" id="votes-{{ $server->id }}">
		<div class="upvote-container vote-action" type="serveris" vote="upvote" id="{{ $server->id }}">
			@if(!$server->voted('up'))
			<i class="fa vote upvote"></i>
			@else
			<i class="fa vote upvote-active"></i>
			@endif
		</div>
		<div class="vote-count-container">
			@if($server->vote_count > 0)
			<span class="positive">
				{{ $server->vote_count }}
			</span>
			@elseif($server->vote_count == 0)
			<span class="neutral">
				{{ $server->vote_count }}
			</span>
			@else
			<span class="negative">
				{{ $server->vote_count }}
			</span>
			@endif
		</div>
		<div class="downvote-container vote-action" type="serveris" vote="downvote" id="{{ $server->id }}">
			@if(!$server->voted('down'))
			<i class="fa vote downvote"></i>
			@else
			<i class="fa vote downvote-active"></i>
			@endif
		</div>
	</div>
	<div class="media-left media-top">
	    <img class="media-object topic-avatar" src="{{ $server->logo }}" alt="{{ $server->name }}">
	</div>
	<div class="media-body">
		<h4 class="media-heading">
			<a href="{{ route('server.show', [$server->slug]) }}" class='no-emojify'>
				{{ $server->name }}
			</a>
		</h4>
		<p class="topic-meta-container">
			<span class="media-meta-element" data-toggle="tooltip" data-placement="top" title="Paskutinis atsakymas">
				<i class="fa fa-comment-o"></i> 
				@if(isset($server->comments[0]))
				{{ $server->comments[0]->created_at->diffForHumans() }}
				@else
				{{ $server->created_at->diffForHumans() }}				
				@endif
			</span>
			<span class="media-meta-element" data-toggle="tooltip" data-placement="top" title="Paskutinio Atsakymo Autorius">
				<i class="fa fa-user"></i>
				@if(isset($server->comments[0]))
				<a href="{{ $server->comments[0]->user->url }}">{{ $server->comments[0]->user->username }}</a>
				@else
				<a href="{{ $server->user->url }}">{{ $server->user->username }}</a>				
				@endif
			</span>
			<span class="media-meta-element" data-toggle="tooltip" data-placement="top" title="Viso Atsakymų">
				<i class="fa fa-comments-o"></i> 
				{{ $server->reply_count }}
			</span>
		</p>
		<p class="topic-meta-container">
			<a href="?rodyti={{ $tab }}&zaidimas={{ $server->game->slug }}"><span class="maze-label {{ $server->game->style_label }} media-meta-element">{{ $server->game->name }}</span></span></a>
			@if($server->is_blocked)
			<span class="media-meta-element maze-label label-misc">
				@if($server->is_blocked)
				<i class="fa fa-fw fa-lock fa-fw" data-toggle="tooltip" title="Serveris užrakinta"></i>
				@endif
			</span>
			@endif
		</p>
	</div>
</div>
