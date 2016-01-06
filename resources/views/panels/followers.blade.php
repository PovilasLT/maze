<div class="panel panel-default">
	  <div class="panel-heading">
			<h3 class="panel-title">Prenumeratoriai</h3>
	  </div>
	  <div class="panel-body">
			<div class="row">
				@if($user->followers()->count() > 0)
				@foreach($user->followers()->latest()->limited() as $follower)
					<div class="col-md-4 follower-container">
						<a href="{{ route('user.show', $follower->follower->slug) }}"><img class="follower-avatar" src="{{ $follower->follower->avatar }}" title="{{ $follower->follower->username }}" alt="{{ $follower->follower->username }}"></a>
					</div>
				@endforeach
				@else
				<div class="col-md-12 text-center">
					Prenumeratorių nėra. 
					@if($user->id != Auth::user()->id)
						<a href="{{ route('user.follow', $user->slug) }}">Būk pirmas!</a>
					@endif
				</div>
				@endif
			</div>
			<div class="text-center help-block">
				<p><a href="{{ route('user.followers', $user->slug) }}">Rodyti Visus</a></p>
			</div>
	  </div>
</div>