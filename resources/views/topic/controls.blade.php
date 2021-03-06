<div class="topic-controls">
	@if(Auth::check() && (Auth::user()->can('manage_topics') || (Auth::user()->id == $topic->user_id && !$topic->is_blocked)))
	<a href="{{ route('topic.edit', $topic->slug) }}"><button type="button" class="btn btn-grey"><i class="fa fa-pencil"></i></button></a>
	@if(!Auth::user()->can('manage_topics') && !$topic->is_blocked)
	<a href="{{ route('topic.delete', $topic->slug) }}"><button type="button" class="btn btn-grey"><i class="fa fa-trash"></i></button></a>
	@endif
	@endif
	@if(Auth::check() && Auth::user()->can('manage_topics'))
	<div class="btn-group">
	   <button type="button" class="btn btn-grey dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    <i class="fa fa-cog"></i> <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a href="{{ route('topic.pinLocal', [$topic->slug]) }}"><i class="fa fa-thumb-tack"></i> Prisegti skiltyje</a></li>
	    <li><a href="{{ route('topic.pinGlobal', [$topic->slug]) }}"><i class="fa fa-bullhorn"></i> Prisegti globaliai</a></li>
	    @if ($topic->order == 1 || $topic->pin_local == 1)
	    	<li><a href="{{ route('topic.unpin', [$topic->slug]) }}"><i class="fa fa-undo"></i> Atsegti</a></li>
	    @endif
	    @if ($topic->order == -1 && $topic->pin_local == -1)
	    	<li><a href="{{ route('topic.unsink', [$topic->slug]) }}"><i class="fa fa-anchor"></i> Atgaivinti</a></li>
	    @else
	    	<li><a href="{{ route('topic.sink', [$topic->slug]) }}"><i class="fa fa-anchor"></i> Nuskandinti</a></li>
	    @endif
	    <li class="divider"></li>
	    <li>
	    	<a href="#" data-toggle="modal" data-target='#topic-confirm-delete-{{ $topic->id }}'><i class="fa fa-trash"></i> Ištrinti</a>
	    </li>
	    <li><a href="{{ route('topic.lock', [$topic->slug]) }}"><i class="fa fa-lock"></i> Užrakinti</a></li>
	  </ul>
	</div>
	@endif
</div>
