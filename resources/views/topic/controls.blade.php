<div class="topic-controls">
	@if(Auth::check() && (Auth::user()->can('manage_topics') || Auth::user()->id == $topic->user_id))
	<a href="{{ route('topic.edit', $topic->id) }}"><button type="button" class="btn btn-grey"><i class="fa fa-pencil"></i></button></a>
	@if(!Auth::user()->can('manage_topics') && $topic->is_blocked)
	<a href="{{ route('topic.delete', $topic->id) }}"><button type="button" class="btn btn-grey"><i class="fa fa-trash"></i></button></a>
	@endif
	@endif
	@if(Auth::check() && Auth::user()->can('manage_topics'))
	<div class="btn-group">
	   <button type="button" class="btn btn-grey dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    <i class="fa fa-cog"></i> <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
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