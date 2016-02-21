<h2 class="big-heading">
	Slaptažodžio Nustatymai
</h2>

<form class="user-settings margin-bottom" action="{{ route('settings.password.save') }}" method="POST" role="form">
	
	@include('includes.csrf')

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