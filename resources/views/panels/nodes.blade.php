<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Forumo Skiltys</h3>
  </div>
  <div class="panel-body">
	<ul class="node-list">
    @foreach(maze\Node::parents() as $parent)
    	<li id="parent-node-{{ $parent->id }}"><i class="fa fa-plus parent-icon" id="{{$parent->id}}"></i><a href="{{ route('node.show', $parent->slug) }}">{{ $parent->name }}</a></li>
    	<ul class="child-node-list parent-node-collection-{{ $parent->id }}">
    		@foreach($parent->children as $child)
			<li>
    			<a href="{{ route('node.show', $child->slug) }}">{{ $child->name }}</a>
    		</li>
    		@endforeach
    	</ul>
    @endforeach
	</ul>
  </div>
</div>