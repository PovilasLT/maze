<h2 class="big-heading">
	TV Nustatymai
</h2>

<div class="panel panel-primary">
	  <div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-twitch"></i> 
				Twitch Kanalas 
				@if($streamer) 
					<a href="{{ route('streamer.show', [$streamer->twitch]) }}" target="_blank">({{ $streamer->twitch }} <i class="fa fa-link"></i>)</a> 
				@else 
					(Neužregistruotas) 
				@endif
			</h3>
	  </div>
	  <div class="panel-body">

			<div class="row">
				<div class="col-md-6">
					<p>Norint, kad tavo kanalas atsirastų <a href="http://tv.maze.lt" target="_blank">Maze TV puslapyje</a>, privalai prisijungti naudodamas savo Twitch.tv paskyrą.</p>
				</div>
				<div class="col-md-6 text-center">
					<a href="https://api.twitch.tv/kraken/oauth2/authorize?response_type=code&client_id={{ env('TWITCH_CLIENT_ID') }}&redirect_uri=https://{{ env('DOMAIN') }}/nustatymai/tv&scope=user_read" class="btn btn-lg btn-success"><i class="fa fa-twitch"></i> Prisijungti su Twitch</a>					
				</div>
			</div>

			@if($streamer)
				<form action="{{ route('settings.tv.save') }}" method="POST">
					@include('includes.csrf')
					
					<div class="row">
						<div class="form-group col-sm-12">
							<label>Facebook</label>
							<input type="text" class="form-control" id="" name="facebook" value="{{ $streamer->facebook or "" }}">
							<p class="help-block">Nuoroda į Facebook puslapį arba paskyrą.</p>
						</div>
					</div>

					<div class="row">
						<div class="form-group col-sm-12">
							<label>YouTube</label>
							<input type="text" class="form-control" id="" name="youtube" value="{{ $streamer->youtube or ""  }}">
							<p class="help-block">Nuoroda į YouTube Kanalą.</p>
						</div>
					</div>

					<div class="row">
						<div class="form-group col-sm-12">
							<label>Parama</label>
							<input type="text" class="form-control" id="" name="donate" value="{{ $streamer->donate or ""  }}">
							<p class="help-block">Nuoroda į paramos puslapį.</p>
						</div>
					</div>

					<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Išsaugoti</button>
					<br class="clearfix">
				</form>
			@endif
	  </div>
</div>