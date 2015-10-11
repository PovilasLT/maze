<div class="user-meta text-center">
	<img src="{{ $user->avatar }}" class="avatar profile">
	<h1>{{ $user->username }}</h1>
	@if($user->is_banned)
		<h2 class="banhammer">Užblokuotas</h2>
	@endif
	@if($user->about_me)
		<p class="text-left about-me">
			{{ $user->about_me }}
		</p>
	@endif
	@if(!$user->is_banned && Auth::check())
		<a href="{{ route('user.follow', [$user->slug]) }}" class="btn btn-primary full-width user-button"><i class="fa fa-rss"></i> 
			@if($user->is_following)
			Nebeprenumeruoti
			@else
			Prenumeruoti
			@endif
		</a>
		<a href="#" class="btn btn-primary full-width user-button"><i class="fa fa-envelope"></i> Asmeninė Žinutė</a>
	@endif
</div>
@if(Auth::check() && Auth::user()->is_staff)
	@include('panels.user_admin')
@endif
@include('panels.about')
@include('panels.user_statistics')
@include('panels.followers')