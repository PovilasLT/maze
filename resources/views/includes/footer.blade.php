		<footer>
			<div class="container">
				<div class="row">
					<div class="col-lg-10">
						<h4>Apie maze</h4>
						<p>Maze yra platforma, kurios tikslas yra suteikti "geimeriams" viską, ko gali reikėti propoguojant šį pomėgį. Vienas iš projekto siekių yra išlaikyti kompiuterinių žaidimų žaidėjus įvykių centre, suteikti jiems sąlygas diskutuoti, tobulėti, įgyti naujus įgūdžius, mokytis ir mokyti kitus.</p>
					</div>
					<div class="col-lg-2">
						<h4>Nuorodos</h4>
						<ul>
							<li>
								<a href="{{ route('page.team') }}">Komanda</a>
							</li>
							<li>
								<a href="{{ route('page.about') }}">Apie</a>
							</li>
							<li>
								<a href="{{ route('node.show', 'naujienos') }}">Naujienos</a>
							</li>
							<li>
								<a href="{{ route('page.contact') }}">Susisiekti</a>
							</li>
							<li>
								<a href="{{ route('page.knowledgebase') }}">Žinynas</a>
							</li>
							<li>
								<a href="{{ route('page.rules') }}">Etiketas</a>
							</li>
						</ul>
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
		<script src="{{ elixir("js/scripts.js") }}"></script>
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