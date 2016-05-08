<div class="media post-show" id="komentaras-{{ $comment->id }}">
  <div class="votes reply-votes @if(Auth::check() && !Auth::user()->can_vote) votes-disabled @endif pull-left" id="votes-{{ $comment->id }}">
    <div class="upvote-container vote-action" type="serverio-komentaras" vote="upvote" id="{{ $comment->id }}">
      @if(!$comment->voted('up'))
      <i class="fa vote upvote"></i>
      @else
      <i class="fa vote upvote-active"></i>
      @endif
    </div>
    <div class="vote-count-container">
      @if($comment->vote_count > 0)
      <span class="positive">
        {{ $comment->vote_count }}
      </span>
      @elseif($comment->vote_count == 0)
      <span class="neutral">
        {{ $comment->vote_count }}
      </span>
      @else
      <span class="negative">
        {{ $comment->vote_count }}
      </span>
      @endif
    </div>
    <div class="downvote-container vote-action" type="serverio-komentaras" vote="downvote" id="{{ $comment->id }}">
      @if(!$comment->voted('down'))
      <i class="fa vote downvote"></i>
      @else
      <i class="fa vote downvote-active"></i>
      @endif
    </div>
  </div>
  <div class="media-left media-top">
    <a href="{{ route('user.show', $comment->user->slug) }}">
      <img class="media-object reply-avatar" src="{{ $comment->user->avatar }}" alt="{{ $comment->user->username }} Profilis">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading">
      @include('includes.tv_icon', ['user' => $comment->user])
      <a href="{{ route('user.show', $comment->user->slug) }}" class="author">{{ $comment->user->username }}</a>
      <small class="date-when">{{ $comment->created_at->diffForHumans() }}</small>
      @include('server_comment.controls')
    </h4>
    <div class="lightbox">
      {!! $comment->body !!}
    </div>
  </div>
</div>