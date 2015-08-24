<div class="panel panel-default">
	  <div class="panel-heading">
			<h3 class="panel-title">Administravimas</h3>
	  </div>
	  <div class="panel-body">
	  		@if(!$user->is_banned)
	  		<a href="ban" class="btn btn-danger user-button full-width"><i class="fa fa-ban"></i> Užblokuoti</a>
	  		@else
			<a href="ban" class="btn btn-success user-button full-width"><i class="fa fa-ban"></i> Atblokuoti</a>
	  		@endif
	  		@if($user->can_vote)
	  		<a href="ban" class="btn btn-danger user-button full-width"><i class="fa fa-thumbs-o-down"></i> Išjungti Balsus</a>
	  		@else
	  		<a href="ban" class="btn btn-success user-button full-width"><i class="fa fa-thumbs-o-up"></i> Įjungti Balsus</a>
	  		@endif
	  </div>
</div>