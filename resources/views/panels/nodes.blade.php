<div class="panel panel-default" id="panel-nodes">
  <div class="panel-heading">
    <h3 class="panel-title">
      <i class="fa fa-bars fa-fw"></i> Forumo Skiltys
    </h3>
  </div>
  <div class="panel-body">
	<ul class="node-list" data-update-url="{{ route('nodes.update') }}">
    @foreach(maze\Node::parents() as $parent)
      <li id="parent-node-{{ $parent->id }}" class="
      @if(isset($expandable) && $expandable == $parent->id) is-expanded @endif 
      @if(isset($node) && $node->id == $parent->id) active-node @endif
      ">
        <i class="fa fa-plus parent-icon" id="{{ $parent->id }}"></i>
        <a href="{{ route('node.show', $parent->slug) }}" data-toggle="tooltip" title="{{ $parent->description }}">
          {{ $parent->name }}
        </a>
      </li>
      <ul class="child-node-list parent-node-collection-{{ $parent->id }}">
        @foreach($parent->children as $child)
          <li @if(isset($node) && $node->id == $child->id) class="active-node" @endif >
            <a href="{{ route('node.show', $child->slug) }}" data-toggle="tooltip" title="{{ $child->description }}">{{ $child->name }}</a>
          </li>
        @endforeach
      </ul>
    @endforeach
	</ul>
  </div>
</div>