@include('includes.header')
		<main id="content">
			<div class="container">
			@include('includes.messages')
					<div class="row">
						<button class="btn btn-success btn-lg btn-block visible-sm visible-xs" id="toggle-sidebar"><i class="fa fa-bars"></i></button>
						<div class="col-md-9 main-content is_visible">
							@yield('breadcrumbs')
							<div class="col-lg-12 content-box">
								@yield('content')
							</div>
						</div>
						<div class="col-md-3 hidden-sm hidden-xs main-sidebar">
							<div id="sidebar-affix-container">
								@include('includes.user_info')
								@yield('sidebar')
							</div>
						</div>
					</div>
			</div>
		</main>
@include('includes.footer')