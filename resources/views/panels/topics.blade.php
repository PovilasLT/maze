<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Panašios Temos</h3>
  </div>
  <div class="panel-body">
    <ul class="similar-topics">
      @foreach($topic->sameNodeTopics() as $similarTopic)
        <li>
          <a href="{{ route('topic.show', $similarTopic->slug) }}">
            {{ $similarTopic->title }}
          </a>
        </li>
      @endforeach
    </ul>
  </div>
</div>