@if(isset($node))
<a href="{{ route('topic.create', ['skiltis' => $node->id]) }}" class="btn btn-success full-width new-topic"><i class="fa fa-plus-square"></i> Kurti naują temą
</a>
@else
<a href="{{ route('topic.create') }}" class="btn btn-success full-width new-topic"><i class="fa fa-plus-square"></i> Kurti naują temą
</a>
@endif
@include('panels.nodes', ['front_page_nodes' => Auth::check() ? Auth::user()->frontPageNodes()->toArray() : false ])
@include('panels.streams')
@include('panels.statuses')