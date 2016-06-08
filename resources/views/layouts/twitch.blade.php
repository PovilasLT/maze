@include('includes.header')
	<main id="content">
		<div class="container">
		@include('includes.messages')
			@yield('breadcrumbs')
			<div class="row">
				<div class="col-md-3">
					@if(Auth::check())
						@include('twitch.includes.menu')
					@else
						@include('includes.user_info')
					@endif
				</div>
				<div class="col-md-9 main-content is_visible">
					<div class="content-box">
						@yield('content')
					</div>
				</div>
			</div>
		</div>
	</main>
@include('includes.footer')