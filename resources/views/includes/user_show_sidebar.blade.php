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
	<a href="#" class="btn btn-primary full-width user-button"><i class="fa fa-rss"></i> Prenumeruoti</a>
	<a href="#" class="btn btn-primary full-width user-button"><i class="fa fa-envelope"></i> Asmeninė Žinutė</a>
</div>
@include('panels.about')
@include('panels.followers')
@include('panels.user_statistics')