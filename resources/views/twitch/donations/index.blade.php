@extends('layouts.blank')

@section('title')
Parama {{ $channel->streamer->twitch }}
@stop

@section('content')
	<div class="row" id="donation-page">
		<div class="col-md-6 col-md-offset-3">
			<div class="banner" style="background-image: url('https://cdn1.artstation.com/p/assets/images/images/001/455/909/large/alex-ducreux-ducreuxa-td-model.jpg?1446732604')">
				<div class="subtitle">
					<h3>{{ $channel->streamer->twitch }}</h3>
					<a href="http://twitch.tv/{{ $channel->streamer->twitch }}" target="_blank" class="pull-right"><i class="fa fa-twitch"></i> twitch.tv/{{ $channel->streamer->twitch }}</a>	
				</div>
			</div>
			@include('includes.messages')
			<div class="row">
				<div class="col-lg-12">
					<p class="donation-page-message">{{ $channel->donation_message or 'Parama '.$channel->streamer->twitch.' kanalui.' }}</p>
				</div>
			</div>
			<div class="well">
				<form action="{{ route('twitch.donations.gateway', [$channel]) }}" method="POST" role="form" class="form-horizontal">
				{{ csrf_field() }}			
					<div class="form-group">
						<div class="col-sm-8">
							<label>Vardas</label>
							<input type="text" class="form-control" name="username" placeholder="Tavo Twitch.TV vardas" value="{{ $username or '' }}">
						</div>
						<div class="col-sm-4">
							<label>Paramos Suma</label>
							<div class="input-group">
							  <input type="text" class="form-control" placeholder="1.00" name="amount" value="{{ old('amount') }}">
							  <span class="input-group-addon">EUR</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-12">
							<label>Žinutė</label>
							<textarea name="body" cols="20" rows="10" class="form-control" placeholder="Tavo išmintingos žinutės turinys...">{{ old('body') }}</textarea>
						</div>
					</div>
					<button type="submit" class="btn btn-primary btn-block btn-lg"><i class="fa fa-gift"></i> Paremti!</button>
				</form>
			</div>
		</div>
	</div>
@stop