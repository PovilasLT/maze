<div class="col-lg-12 navbar-user-info">
	@if(Auth::check())
		<a href="{{ route('user.profile') }}"><img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->username }} Profilis" class="avatar"></a>
		<a href="{{ route('user.profile') }}"><i class="fa fa-globe"></i></a>
		<a href="" class="user-messages-icon"><i class="fa fa-envelope-o"></i><span>3</span></a>
		<a href="{{ route('auth.logout') }}"><i class="fa fa-sign-out"></i></a>
	@else
		<div class="logged-out-wrapper">
			<a href="{{ route('auth.login') }}"><button type="button" class="btn btn-primary"><i class="fa fa-sign-in"></i>Prisijungti</button></a>
			<a href="{{ route('auth.register') }}"><button type="button" class="btn btn-primary"><i class="fa fa-user-plus"></i>Registruotis</button></a>
		</div>
	@endif
</div>