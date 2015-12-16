@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('user.settings', $user, $user) !!}
@stop

@section('content')

	<div class="panel panel-primary">
		  <div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-user"></i> Pagrindiniai Duomenys</h3>
		  </div>
		  <div class="panel-body">
				<form action="{{ route('user.settings.save') }}" method="POST" role="form">
				@include('includes.csrf')
					<div class="row">					
						<div class="col-md-6">
							<div class="form-group">
								<label for="">El-Paštas</label>
								<input type="email" class="form-control" name="email" id="" value="{{ $user->email }}">
							</div>
							<div class="form-group">
								<label>Apie Mane</label>
								<textarea class="form-control" name="about_me">{{ $user->about_me }}</textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Miestas</label>
								<input type="text" class="form-control" id="" name="city" value="{{ $user->city }}">
							</div>	
							<div class="form-group">
								<label>Lytis</label>
								<select name="sex" class="form-control" required="required">
									<option value="1" @if($user->getOriginal('sex') == 1) selected @endif>Vyras</option>
									<option value="0" @if($user->getOriginal('sex') == 0) selected @endif>Moteris</option>
								</select>
							</div>
						</div>
					</div>

					<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Išsaugoti</button>
					<br class="clearfix">
				</form>
		  </div>
	</div>

	<div class="panel panel-primary">
		  <div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-users"></i> Socialiniai Tinklai</h3>
		  </div>
		  <div class="panel-body">
				<form action="{{ route('user.settings.save') }}" method="POST">
					@include('includes.csrf')
					<div class="row">
						<div class="form-group col-sm-6">
							<label for="">Twitter</label>
							<input type="text" class="form-control" id="" name="twitter" value="{{ $user->getOriginal('twitter') }}">
						</div>

						<div class="form-group col-sm-6">
							<label for="">Steam</label>
							<input type="text" class="form-control" id="" name="steam" value="{{ $user->getOriginal('steam') }}">
						</div>

						<div class="form-group col-sm-6">
							<label for="">Twitch</label>
							<input type="text" class="form-control" id="" name="twitch" value="{{ $user->getOriginal('twitch') }}">
						</div>	

						<div class="form-group col-sm-6">
							<label for="">Youtube</label>
							<input type="text" class="form-control" id="" name="youtube" value="{{ $user->getOriginal('youtube') }}">
						</div>
					</div>

					<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Išsaugoti</button>
					<br class="clearfix">
				</form>
		  </div>
	</div>

	<div class="panel panel-primary">
		  <div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-camera-retro"></i> Avataras</h3>
		  </div>
		  <div class="panel-body">
				<form action="{{ route('user.settings.save') }}" method="POST" enctype="multipart/form-data">
					@include('includes.csrf')
					<div class="row">
						<div class="col-md-6">
							<input type="file" name="avatar">
<!-- 							<button class="btn btn-danger full-width margin-top">
								Ištrinti avatarą.
							</button> -->
						</div>
						<div class="col-md-6">
							Avataro reikalavimai:
							<ul>
								<li>
									Tik <strong>.JPG</strong> ir <strong>.PNG</strong> formatas. Premium nariai gali naudoti ir <strong>.GIF</strong>.
								</li>
								<li>
									Avatarai didesni nei <strong>150x150 px</strong> bus sumažinti iki atitinkamo dydžio.
								</li>
							</ul>
						</div>
					</div>

					<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Išsaugoti</button>
					<br class="clearfix">
				</form>
		  </div>
	</div>

	<div class="panel panel-primary">
		  <div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-envelope"></i> Laiškų Siuntimas</h3>
		  </div>
		  <div class="panel-body">
				<form method="POST" action="{{ route('user.settings.save') }}">
					@include('includes.csrf')
					<div class="form-group">
						<p>Gauti laiškus apie:</p>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="email_replies" value="1" @if($user->email_replies) checked @endif>
								pranešimus į prenumeruojamas temas.
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="email_messages" value="1" @if($user->email_messages) checked @endif>
								naujas asmenines žinutes.
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="email_news" value="1" @if($user->email_news) checked @endif>
								bendruomenės atnaujinimus.
							</label>
						</div>
					</div>

					<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Išsaugoti</button>
					<br class="clearfix">
				</form>
		  </div>
	</div>

	<form class="user-settings margin-bottom" action="{{ route('user.settings.save') }}" method="POST" role="form">
		@include('includes.csrf')
		<h3>
			<i class="fa fa-asterisk"></i>
			Slaptažodžio Keitimas
		</h3>

		<div class="form-group">
			<label for="">Dabartinis Slaptažodis</label>
			<input type="password" name="password" class="form-control" id="">
		</div>

		<div class="form-group">
			<label for="">Naujas Slaptažodis</label>
			<input type="password" name="npassword" class="form-control" id="">
		</div>

		<div class="form-group">
			<label for="">Slaptažodžio Patvirtinimas</label>
			<input type="password" name="npassword_confirmation" class="form-control" id="">
		</div>		
	
		<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Išsaugoti</button>
		<br class="clearfix">
	</form>
@stop

@section('sidebar')
	@include('includes.user_sidebar')
@stop