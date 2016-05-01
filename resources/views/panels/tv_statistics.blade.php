<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-bar-chart fa-fw"></i> Statistika</h3>
  </div>
  <div class="panel-body">
    <ul>
    	<li><strong>{{ number_format(maze\Statistics::streams(), 0) }}</strong> viso streamų</li>
    	<li><strong>{{ number_format(maze\Statistics::online_streams(), 0) }}</strong> gyvų streamų</li>
    	<li><strong>{{ number_format(maze\Statistics::watching_now(), 0) }}</strong> dabar žiūrinčių</li>
    </ul>
  </div>
</div>