<form action="" method="POST" role="form">
@include('includes.csrf')
	<div class="form-group">
		<textarea data-provide="markdown" name="body" id="inputBody" class="form-control" rows="3" required="required" placeholder="Kas naujo?"></textarea>
	</div>
	<button type="submit" class="btn btn-primary pull-right">Atnaujinti</button>
	<div class="clearfix"></div>
</form>