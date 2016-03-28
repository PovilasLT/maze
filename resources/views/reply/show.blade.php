@if(!$reply->is_answer)
<div class="media post-show" id="pranesimas-{{ $reply->id }}">
@else
<div class="media post-show post-answer emojify" id="pranesimas-{{ $reply->id }}">
@endif
  <div class="votes reply-votes @if(Auth::check() && !Auth::user()->can_vote) votes-disabled @endif pull-left" id="votes-{{ $reply->id }}">
    <div class="upvote-container vote-action" type="pranesimas" vote="upvote" id="{{ $reply->id }}">
      @if(!$reply->voted('up'))
      <i class="fa vote upvote"></i>
      @else
      <i class="fa vote upvote-active"></i>
      @endif
    </div>
    <div class="vote-count-container">
      @if($reply->vote_count > 0)
      <span class="positive">
        {{ $reply->vote_count }}
      </span>
      @elseif($reply->vote_count == 0)
      <span class="neutral">
        {{ $reply->vote_count }}
      </span>
      @else
      <span class="negative">
        {{ $reply->vote_count }}
      </span>
      @endif
    </div>
    <div class="downvote-container vote-action" type="pranesimas" vote="downvote" id="{{ $reply->id }}">
      @if(!$reply->voted('down'))
      <i class="fa vote downvote"></i>
      @else
      <i class="fa vote downvote-active"></i>
      @endif
    </div>
  </div>
  <div class="media-left media-top">
    <a href="{{ route('user.show', $reply->user->slug) }}">
      <img class="media-object reply-avatar" src="{{ $reply->user->avatar }}" alt="{{ $reply->user->username }} Profilis">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading">
      <a href="{{ route('user.show', $reply->user->slug) }}" class="author">{{ $reply->user->username }}</a>
      <small class="date-when">{{ $reply->created_at->diffForHumans() }}</small>
      @include('reply.controls')
      @if(Auth::check() && (!isset($votes) || $votes) && $reply->topic->user->id == Auth::user()->id && $reply->topic->type == 2 && !$reply->topic->is_answered)
        <small class="pull-right"><a href="{{ route('reply.answer', $reply->id) }}">Atsakymas</a></small>
      @elseif($reply->topic->type == 2 && $reply->topic->is_answered && $reply->is_answer)
        <span class="pull-right label label-success"><i class="fa fa-check-circle"></i> Atsakymas</span>
      @endif
    </h4>
    <div class="lightbox">
      {!! $reply->body !!}
    </div>
  </div>
</div>