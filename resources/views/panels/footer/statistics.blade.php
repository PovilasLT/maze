<div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title">Statistika</h4>
  </div>
  <div class="panel-body">
    <ul>
    	<li><strong>{{ number_format(maze\Statistics::replies(), 0)}}</strong> pranešimų</li>
    	<li><strong>{{ number_format(maze\Statistics::topics(), 0) }}</strong> temų</li>
    	<li><strong>{{ number_format(maze\Statistics::users(), 0) }}</strong> narių</li>
    	<li><strong>{{ number_format(maze\Statistics::karma(), 0) }}</strong> karmos</li>
    </ul>
  </div>
</div>