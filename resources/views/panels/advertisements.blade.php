@if (isset($advertisements))

	<div class="panel panel-default">
		  <div class="panel-heading">
				<h3 class="panel-title">Skelbimai</h3>
		  </div>
		  <div class="panel-body">
				@foreach($advertisements as $topic)
					@include('topic.sidebar-item')
				@endforeach
		  </div>
	</div>

@endif