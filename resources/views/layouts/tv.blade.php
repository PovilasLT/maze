@include('includes.header')
		<main id="tv">
			<div class="container">
			@include('includes.messages')
				<div class="row">
					<div class="@if(isset($sidebar)) col-md-9 @else col-md-12 tv-no-border @endif main-content is_visible">
						@yield('breadcrumbs')
						<div class="col-lg-12 content-box">
							@yield('content')
						</div>
					</div>
					@if(isset($sidebar))
					<div class="col-md-3 hidden-sm hidden-xs main-sidebar">
						<div id="sidebar-affix-container">
							@include('panels.games')
							@include('panels.tv_recommended')
							@include('panels.tv_statistics')
						</div>
					</div>
					@endif
				</div>
			</div>
		</main>
@include('includes.footer')