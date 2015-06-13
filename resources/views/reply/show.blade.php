<div class="panel panel-default">
	  <div class="panel-heading">
			<h3 class="panel-title">{{ $reply->user->username }} <small class="pull-right"><a href="#">Atsakymas</a></small></h3>
	  </div>
	  <div class="panel-body">
			{!! $reply->body !!}
	  </div>
	  @if(Auth::check() && (Auth::user()->can('manage_replies') || Auth::user()->id == $reply->user_id))
	  <div class="panel-footer">
	  	<div class="btn-group" role="group" aria-label="...">
		  <a href="#"><button type="button" class="btn btn-sm btn-success">Redaguoti</button></a>
		  <a href="#"><button type="button" class="btn btn-sm btn-danger">Ištrinti</button></a>
		</div>
	  </div>
	  @endif
</div>