<div class="user-meta text-center">
	<img src="{{ $user->avatar }}" class="avatar profile">
	<h1>{{ $user->username }}</h1>
	@if($user->about_me)
		<p class="text-left about-me">
			{{ $user->about_me }}
		</p>
	@endif
	<a href="#" class="btn btn-primary full-width user-button"><i class="fa fa-cog"></i> Nustatymai</a>
</div>
@include('panels.about')
@include('panels.user_statistics')
@include('panels.followers')