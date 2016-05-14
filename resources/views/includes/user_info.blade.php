<div class="col-lg-12 navbar-user-info">
	@if(Auth::check())
		<a href="{{ route('user.profile') }}"><img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->username }} Profilis" class="avatar"></a>
		<span class="user-notifications-icon like-link notifications" data-toggle="tooltip" title="Pranešimai"><i class="fa fa-lg fa-fw fa-globe"></i>
			@if($notification_count = Auth::user()->notification_count)
				<span>{{ $notification_count }}</span>
			@else
				<span style="display: none;">0</span>
			@endif
		</span>
		<a href="{{ route('conversation.index') }}" class="user-messages-icon" data-toggle="tooltip" title="Asmeninės Žinutės"><i class="fa fa-lg fa-fw fa-envelope-o"></i>
			@if($message_count = Auth::user()->message_count)
				<span>{{ $message_count }}</span>
			@else
				<span style="display: none;">0</span>
			@endif
		</a>
		<a href="{{ route('settings.user') }}" data-toggle="tooltip" title="Nustatymai"><i class="fa fa-cog fa-lg fa-fw"></i></a>
		<a href="{{ route('auth.logout') }}" data-toggle="tooltip" title="Atsijungti"><i class="fa fa-sign-out fa-lg fa-fw"></i></a>
	@else
		<div class="logged-out-wrapper">
			<a href="{{ route('auth.login') }}" class="btn btn-bigger btn-primary full-width external-uri"><i class="fa fa-sign-in"></i>Prisijungti</a>
			<a href="{{ route('auth.register') }}" class="btn btn-bigger btn-info full-width external-uri"><i class="fa fa-user-plus"></i>Registruotis</a>
		</div>
	@endif
</div>