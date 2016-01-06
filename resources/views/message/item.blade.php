<div class="media post-show post-answer">
  <div class="media-left media-top">
    <a href="{{ route('user.show', $message->user->slug) }}">
    	<img class="media-object reply-avatar" src="{{ $message->user->avatar }}" alt="{{ $message->user->username }} Profilis">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading">
    	<a href="{{ route('user.show', $message->user->slug) }}" class="author">{{ $message->user->username }}</a>
    	<small class="pull-right">{{ $message->created_at }}</small>
    </h4>
    <div class="lightbox">
      {!! $message->body !!}
    </div>
  </div>
</div>