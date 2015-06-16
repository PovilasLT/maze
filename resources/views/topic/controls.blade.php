<div class="col-lg-12">
	@if(Auth::check() && (Auth::user()->can('manage_topics') || Auth::user()->id == $topic->user_id))
	<a href="{{ route('topic.edit', $topic->id) }}"><button type="button" class="btn btn-primary"><i class="fa fa-pencil"></i> Redaguoti</button></a>
	<a href="{{ route('topic.delete', $topic->id) }}"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Ištrinti</button></a>
	@endif
	@if(Auth::check() && Auth::user()->can('manage_topics'))
	<div class="btn-group">
	  <button type="button" class="btn btn-success"><i class="fa fa-cogs"></i> Moderavimas</button>
	  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
	    <span class="caret"></span>
	    <span class="sr-only">Toggle Dropdown</span>
	  </button>
	  <ul class="dropdown-menu" role="menu">
	    <li><a href="{{ route('topic.pinLocal', [$topic->id]) }}"><i class="fa fa-thumb-tack"></i> Prisegti skiltyje</a></li>
	    <li><a href="{{ route('topic.pinGlobal', [$topic->id]) }}"><i class="fa fa-bullhorn"></i> Prisegti globaliai</a></li>
	    <li><a href="{{ route('topic.unpin', [$topic->id]) }}"><i class="fa fa-undo"></i> Atsegti</a></li>	    
	    <li><a href="{{ route('topic.sink', [$topic->id]) }}"><i class="fa fa-anchor"></i> Nuskandinti</a></li>
	    <li class="divider"></li>
	    <li><a href="{{ route('topic.delete', [$topic->id]) }}"><i class="fa fa-trash"></i> Ištrinti</a></li>
	    <li><a href="{{ route('topic.lock', [$topic->id]) }}"><i class="fa fa-lock"></i> Užrakinti</a></li>
	  </ul>
	</div>
	@endif
</div>