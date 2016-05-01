@include('includes.header')
	<main id="content">
		<div class="container">
		@include('includes.messages')
			<div class="row">
				<button class="btn btn-success btn-lg btn-block visible-sm visible-xs toggle-sidebar"><i class="fa fa-bars"></i></button>
				<div class="col-md-12 is_visible">
					@yield('breadcrumbs')
					<div class="col-lg-12 content-box">
						@yield('content')
					</div>
				</div>
			</div>
		</div>
	</main>
@include('conversation.create_popover')
@include('conversation.all_popover')
@include('includes.footer')