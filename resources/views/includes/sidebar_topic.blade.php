<a href="{{ route('topic.create') }}"><button type="button" class="btn btn-success full-width new-topic"><i class="fa fa-plus-square"></i> Kurti naują temą</button></a>
@include('panels.nodes')
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Maze Facebook</h3>
  </div>
  <div class="panel-body">
    <div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=227076287421060";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<div class="fb-page" data-href="https://www.facebook.com/pages/MazeLT/1427608720826778?ref=bookmarks" data-width="300" data-hide-cover="false" data-show-facepile="false" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/pages/MazeLT/1427608720826778?ref=bookmarks"><a href="https://www.facebook.com/pages/MazeLT/1427608720826778?ref=bookmarks">Maze.LT</a></blockquote></div></div>
  </div>
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Panašios Temos</h3>
  </div>
  <div class="panel-body">
    <ul>
      @foreach($topic->sameNodeTopics() as $similarTopic)
        <li><a href="{{ route('topic.show', $similarTopic->slug) }}">{{ $similarTopic->title }}</a></li>
      @endforeach
    </ul>
  </div>
</div>