<div class="panel panel-default">
	  <div class="panel-heading">
			<h3 class="panel-title">Apie {{ $user->username }}</h3>
	  </div>
	  <div class="panel-body">
		<ul>
			@foreach($user->information as $field)
				@if(strlen($user->getOriginal($field)))
					@if($user->fieldLink($field))
					<li>{{ $user->readableField($field) }}: <a href="{{ $user->fieldLink($field) }}" target="_blank">{{ $user->{$field} }}</a>
					</li>
					@else
					<li>{{ $user->readableField($field) }}: <strong>{{ $user->{$field} }}</strong></li>
					@endif
				@endif
			@endforeach
		</ul>
	  </div>
</div>