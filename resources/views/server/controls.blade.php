<div class="topic-controls">
	@if(Auth::check())
		@if((Auth::user()->can('manage_servers') || (Auth::user()->id == $server->user_id && !$server->is_blocked)))
			<a href="{{ route('server.edit', $server->slug) }}"><button type="button" class="btn btn-grey"><i class="fa fa-pencil"></i></button></a>
			<a href="#" data-toggle="modal" data-target='#server-confirm-delete-{{ $server->id }}'><button type="button" class="btn btn-grey"><i class="fa fa-trash"></i></button>
		@endif
		@if(Auth::user()->can('manage_servers'))
			<a href="{{ route('server.lock', [$server->slug]) }}">
				<button type='button' class='btn btn-grey'>
					@if($server->is_blocked)
					<i class="fa fa-unlock"></i>
					@else 
					<i class="fa fa-lock"></i>
					@endif
				</button>
			</a>
		@endif
	@endif
</div>
