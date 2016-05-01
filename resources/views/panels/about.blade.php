<div class="panel panel-default">
	  <div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-user fa-fw"></i> {{ $user->role }}</h3>
	  </div>
	  <div class="panel-body">
	  		<ul>
	  		@if($user->has_about)
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
			@else
			<p class="text-center">
				Informacijos nėra!
			</p>
			@endif
		</ul>
	  </div>
</div>