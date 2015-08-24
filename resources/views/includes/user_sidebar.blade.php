<div class="user-meta text-center">
	<img src="{{ $user->avatar }}" class="avatar profile">
	<h1>{{ $user->username }}</h1>
	<a href="#" class="btn btn-primary full-width user-button"><i class="fa fa-rss"></i> Prenumeruoti</a>
	<a href="#" class="btn btn-primary full-width user-button"><i class="fa fa-envelope"></i> Asmeninė Žinutė</a>
</div>
<div class="panel panel-default">
	  <div class="panel-heading">
			<h3 class="panel-title">Apie {{ $user->username }}</h3>
	  </div>
	  <div class="panel-body">
			<ul>
				<li>
					Karma: {{ $user->karma_count }}
				</li>
				<li>
					Pranešimai: {{ $user->reply_count }}
				</li>
				<li>
					Temos: {{ $user->topic_count }}
				</li>
				<li>
					Prenumeratoriai: {{ $user->topic_count }}
				</li>
				<li>
					Temos: {{ $user->topic_count }}
				</li>
			</ul>
	  </div>
</div>
<div class="panel panel-default">
	  <div class="panel-heading">
			<h3 class="panel-title">Statistika</h3>
	  </div>
	  <div class="panel-body">
			<ul>
				<li>
					Karma: {{ $user->karma_count }}
				</li>
				<li>
					Pranešimai: {{ $user->reply_count }}
				</li>
				<li>
					Temos: {{ $user->topic_count }}
				</li>
				<li>
					Prenumeratoriai: {{ $user->topic_count }}
				</li>
				<li>
					Temos: {{ $user->topic_count }}
				</li>
			</ul>
	  </div>
</div>
<div class="panel panel-default">
	  <div class="panel-heading">
			<h3 class="panel-title">Prenumeratoriai</h3>
	  </div>
	  <div class="panel-body">
			<ul>
				<li>
					Karma: {{ $user->karma_count }}
				</li>
				<li>
					Pranešimai: {{ $user->reply_count }}
				</li>
				<li>
					Temos: {{ $user->topic_count }}
				</li>
			</ul>
	  </div>
</div>
<div class="panel panel-default">
	  <div class="panel-heading">
			<h3 class="panel-title">Pasiekimai</h3>
	  </div>
	  <div class="panel-body">
			<ul>
				<li>
					Karma: {{ $user->karma_count }}
				</li>
				<li>
					Pranešimai: {{ $user->reply_count }}
				</li>
				<li>
					Temos: {{ $user->topic_count }}
				</li>
			</ul>
	  </div>
</div>