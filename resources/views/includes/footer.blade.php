		</div>
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						@include('panels.footer.statistics')
					</div>
					<div class="col-md-4">
						@include('panels.footer.links')
					</div>
					<div class="col-md-4">
						@include('panels.footer.social')
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 copyright">
						<p>
							&copy; Maze 2014-{{ date('Y') }}. Visos teisės saugomos.
						</p>
						<p>
							Versija: {{ Config::get('app.version') }}
						</p>
					</div>
				</div>
			</div>
		</footer>
		<script src="{{ elixir("js/app.js") }}"></script>
		@yield('scripts')
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-50852877-1', 'auto');
			ga('send', 'pageview');
		</script>
	</body>
</html>