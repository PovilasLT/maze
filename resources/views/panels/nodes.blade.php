<div class="panel panel-default" id="panel-nodes">
  <div class="panel-heading">
    <h3 class="panel-title">
      Forumo Skiltys
      @if(Auth::check())
        <a href><i class="fa fa-pencil-square-o pull-right edit-front-page-nodes"></i></a>
      @endif
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
        <a href="{{ route('node.show', $parent->slug) }}">
          {{ $parent->name }}
        </a>
      </li>
      <ul class="child-node-list parent-node-collection-{{ $parent->id }}">
        @foreach($parent->children as $child)
          <li @if(isset($node) && $node->id == $child->id) class="active-node" @endif >
            <a href="{{ route('node.show', $child->slug) }}">{{ $child->name }}</a>
            @if(Auth::check())
            <input @if(isset($front_page_nodes) && $front_page_nodes && in_array($child->id, $front_page_nodes)) checked @endif type="checkbox" data-node="{{ $child->id }}" class="toggle-front-page-node pull-left hidden">
            @endif
          </li>
        @endforeach
      </ul>
    @endforeach
	</ul>
  </div>
</div>