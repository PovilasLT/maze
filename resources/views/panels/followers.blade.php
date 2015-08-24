<div class="panel panel-default">
	  <div class="panel-heading">
			<h3 class="panel-title">Apie {{ $user->username }}</h3>
	  </div>
	  <div class="panel-body">
			<ul>
				<li>
					Twitter: <a href="http://twitter.com/{{ $user->twitter }}" target="_blank">{{ $user->twitter }}</a>
				</li>
			</ul>
	  </div>
</div>