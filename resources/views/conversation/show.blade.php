@extends('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('conversation.show', $conversation) !!}
@stop

@section('title')
{{  $receiver->username.' » Pokalbiai | '}} @parent
@stop

@section('content')
	
	<div id="messenger" conversation-id="{{ $conversation->id }}">
		<div class="maze-pagination text-right">
			{!! $messages->render() !!}
		</div>

		@include('message.forms.create')
		
		<div id="messages-container">
			@foreach($messages as $message)
				@include('message.item')
			@endforeach
		</div>

		<div class="maze-pagination text-right">
			{!! $messages->render() !!}
		</div>
	</div>
@stop

@section('sidebar')
	@include('includes.sidebar')
@stop

@section('scripts')
<script src="https://cdn.socket.io/socket.io-1.3.7.js"></script>
<script type="text/javascript">

	var messages_container = $('#messages-container');

	$( "#send-message" ).submit(function( event ) {
	 
		event.preventDefault();

		var $form = $( this ),
		conversation_id = $form.find( "input[name='conversation_id']" ).val(),
		body = $form.find( "textarea[name='body']" ).val(),
		csrf = $form.find( "input[name='_token']" ).val(),
		url = $form.attr( "action" );

		var posting = $.post( url, { _token: csrf, conversation_id: conversation_id, body: body } );

			posting.done(function( data ) {
			if(data !== 'OK')
			{
				alert('Įvyko klaida siunčiant žinutę. Pabandykite šiek tiek vėliau.');
			}
			else
			{
				$form.find( "textarea[name='body']" ).val('');
			}
		});
	});
	var full_url = window.location.href;
	var arr = full_url.split("/");

	var socket = io(arr[0]+'//'+window.location.host+':6001');
	socket.emit('join', {id: {{ $conversation->id }}, secret: '{{ $conversation->secret }}'});
	
	socket.on("message", function(data) {
		messages_container.prepend(data);
		emojify.setConfig({
		    blacklist: {
		                    'ids': [],
		                    'classes': ['no-emojify'],
		                    'elements': ['script', 'textarea', 'pre', 'code']
		                },
		    tag_type: null,
		    only_crawl_id: null,
		    img_dir: '/images/emoji/',
		    ignore_emoticons: false,
		    mode: 'img'
		});
		emojify.run(document.getElementById('content'));
	});
</script>
@stop