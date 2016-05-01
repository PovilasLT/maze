<div class="panel panel-default">
	  <div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-bar-chart fa-fw"></i> Statistika</h3>
	  </div>
	  <div class="panel-body">
			<ul>
				<li>
					Karma: <strong>{{ $user->karma_count }}</strong>
				</li>
				<li>
					Pranešimai: <strong>{{ $user->reply_count }}</strong>
				</li>
				<li>
					Temos: <strong>{{ $user->topic_count }}</strong>
				</li>
				<li>
					Prenumeratoriai: <strong>{{ $user->follower_count }}</strong>
				</li>
				<li>
					Būsenos Atnaujinimai: <strong>{{ $user->status_count }}</strong>
				</li>
			</ul>
	  </div>
</div>