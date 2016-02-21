@if(isset($node))
<a href="{{ route('topic.create', ['skiltis' => $node->id]) }}">
<button type="button" class="btn btn-success full-width new-topic"><i class="fa fa-plus-square"></i> Kurti naują temą</button>
</a>
@else
<a href="{{ route('topic.create') }}">
<button type="button" class="btn btn-success full-width new-topic"><i class="fa fa-plus-square"></i> Kurti naują temą</button>
</a>
@endif
@include('panels.nodes', ['front_page_nodes' => Auth::check() ? Auth::user()->frontPageNodes()->toArray() : false ])
@include('panels.facebook')
@include('panels.statistics')