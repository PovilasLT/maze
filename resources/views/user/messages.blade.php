@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('user.messages') !!}
@stop

@section('sidebar')
	@include('includes.user_sidebar')
@stop

@section('content')
	<div class="media markdown-form status-update-form">
		<div class="media-body">
			<h4 class="media-heading">
				Pradėti naują pokalbį
			</h4>
			<p>
				<form action="{{ route('status.create') }}" method="POST" role="form">
				@include('includes.csrf')
					<div class="form-group">
						<input type="text" name="receiver" id="inputReceiver" class="form-control" required="required" placeholder="Gavėjas">
					</div>
					<div class="form-group">
						<textarea data-provide="markdown" name="body" id="inputBody" class="form-control" rows="1" required="required" placeholder="Žinutės tekstas"></textarea>
					</div>

					<button type="submit" class="btn btn-primary pull-right">Siųsti</button>
					<div class="clearfix"></div>
				</form>
			</p>
		</div>
	</div>

	<div class="row conversations-wrapper">
		<div class="col-md-4 conversations-list">

		@if ( ! empty($conversations))
			@foreach ($conversations as $conversation)

			<div class="media conversation-wrapper" data-conversationId="{{ $conversation->id }}">
				<div class="media-left media-top">
					@if ($conversation->isPrivate())
						<img class="media-object topic-avatar" src="{{ $conversation->messages()->latest()->get()->first()->sender->avatar }}" alt="{{ $conversation->messages()->latest()->get()->first()->sender->username }}">
					@else
						<img class="media-object topic-avatar" src="http://uxrepo.com/static/icon-sets/elusive/png32/512/000000/group-512-000000.png" alt="{{ confer_make_list($conversation->participants()->lists('username')) }}">	
					@endif
				</div>
				<div class="media-body">
					<h4 class="media-heading">
						<a href="#pokalbis-{{ $conversation->id }}">
						@if ($conversation->isPrivate())
							{{ $conversation->participants()->where('id', '!=', $user->id)->get()->first()->username }}
						@else
							{{ confer_make_list($conversation->participants()->lists('username')) }}
						@endif
						</a>
						<a class="silent"><span class="date-when">{{ $conversation->updated_at->diffForHumans() }}</span></a>
					</h4>
					<p class="last-message">
						@if ($conversation->messages()->latest()->get()->first()->sender->id == $user->id)
							Tu:
						@else
							{{ $conversation->messages()->latest()->get()->first()->sender->username }}: 
						@endif
						{{ $conversation->messages()->latest()->get()->first()->body }}
					</p>
					<p>
						@if ($unread = \Message::unread(Auth::user(), $conversation))
							<span class="maze-label label-diskusija media-meta-element "><i class="fa fa-comments-o"></i> Yra naujų žinučių (<span class="unread">{{ $unread }})</span>
						@else
							<span class="maze-label label-klausimas media-meta-element"><i class="fa fa-comments-o"></i> Nėra naujų žinučių</span>
						@endif
							{{-- <span class="media-meta-element">Autorius: <a href="/vartotojas/yiin">Yiin</a> </span> --}}
					</p>
				</div>
			</div>

			@endforeach
		@endif

		</div>
		<div class="col-md-8 conversation-messages-list">
			<div class="media" style="height: 550px">
			
			</div>
		</div>
	</div>
@stop