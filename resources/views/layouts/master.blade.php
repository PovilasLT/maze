@include('includes.header')
		<main id="content">
			<div class="container">
			@include('includes.messages')
				<div class="row">
					<button class="btn btn-success btn-lg btn-block visible-sm visible-xs toggle-sidebar"><i class="fa fa-bars"></i></button>
					<div class="col-md-9 main-content is_visible">
						@yield('breadcrumbs')
						<div class="col-lg-12 content-box">
							@yield('content')
						</div>
					</div>
					<div class="col-md-3 hidden-sm hidden-xs main-sidebar" id="main-sidebar">
						@include('includes.user_info')
						@yield('sidebar')
					</div>
				</div>
			</div>
		</main>

		@if(Auth::check())
			<div id="notifications-container">
				<div class="row notification-controls-wrapper small-text">
					<div class="row">
						<div class="col-xs-6"><strong>Pranešimai</strong></div>
						<div class="col-xs-6 text-right"><span class="like-link action-mark-read-notifications"><i class="fa fa-check" data-toggle="tooltip" data-placement="top" title="Žymėti visus perskaitytais"></i></span></div>
					</div>
				</div>
				<div class="notification-list quick-notification-list">
					@foreach(Auth::user()->quickNotifications() as $notification)
						<div 
						class="
						media 
						notification-list-item
						notification-item-{{ $notification->id }}
						@if(!$notification->is_read)
						notification-unread
						@endif
						"
						>
							<a class="pull-left" href="{{ $notification->fromUser->url }}">
								<img class="media-object small-avatar" src="{{ $notification->fromUser->avatar }}">
							</a>
							<div class="media-body">
								<p>
									<a href="{{ $notification->fromUser->url }}">{{ $notification->fromUser->username }}</a>
									{!! $notification->object->notification !!}
								</p>
							</div>
						</div>
					@endforeach
				</div>
				<div class="notifications-helper text-center small-text">
					<a href="{{ route('user.profile') }}">Rodyti Visus</a>
				</div>
			</div>
		@endif

@include('includes.footer')