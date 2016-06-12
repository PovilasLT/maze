@if(isset($node))
<a href="{{ route('topic.create', ['skiltis' => $node->id]) }}" class="btn btn-success full-width new-topic"><i class="fa fa-plus-square-o"></i> Kurti Temą
</a>
@else
<a href="{{ route('topic.create') }}" class="btn btn-success full-width new-topic"><i class="fa fa-plus-square-o"></i> Kurti Temą
</a>
@endif
@if(\Route::is('node.show'))
	@include('panels.nodes.info')
@endif
@include('panels.nodes', ['front_page_nodes' => Auth::check() ? Auth::user()->frontPageNodes()->toArray() : false ])
@include('panels.streams')
@include('panels.statuses')