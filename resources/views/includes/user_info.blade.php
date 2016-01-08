<div class="row">
	<div class="col-lg-12 navbar-user-info">
		@if(Auth::check())
			<a href="{{ route('user.profile') }}"><img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->username }} Profilis" class="avatar"></a>
			<a href="{{ route('user.profile') }}" class="user-notifications-icon"><i class="fa fa-globe"></i>
				@if($notification_count = Auth::user()->notification_count)
					<span>{{ $notification_count }}</span>
				@endif
			</a>
			<a href="{{ route('conversation.index') }}" class="user-messages-icon"><i class="fa fa-envelope-o"></i>
				@if($message_count = Auth::user()->message_count)
					<span>{{ $message_count }}</span>
				@endif
			</a>
			<a href="{{ route('auth.logout') }}"><i class="fa fa-sign-out"></i></a>
		@else
			<div class="logged-out-wrapper">
				<a href="{{ route('auth.login') }}"><button type="button" class="btn btn-bigger btn-primary full-width"><i class="fa fa-sign-in"></i>Prisijungti</button></a>
				<a href="{{ route('auth.register') }}"><button type="button" class="btn btn-bigger btn-info full-width"><i class="fa fa-user-plus"></i>Registruotis</button></a>
			</div>
		@endif
	</div>
</div>