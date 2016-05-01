var Backbone = require('backbone');
var emojify = require('emojify.js');

var Conversation = Backbone.View.extend({
	'el': '.active-conversation',
	'events': {
		'submit #send-message': '_sendMessage',
		'keyup #send-message textarea': '_keyUpMessage'
	},
	initialize: function(id) {
		this.id = id;
		this._bindEvends();
	},
	_bindEvends: function() {
		socket.on('messages', this._onMessage.bind(this));
	},
	_sendMessage: function(e) {
		e.preventDefault();
		var $form = $(e.currentTarget);
		var conversation_id = $form.find( "input[name='conversation_id']" ).val();
		var body = $form.find("textarea[name='body']").val();
		var csrf = $form.find("input[name='_token']").val();
		var url = $form.attr("action");
		var posting = $.post(url, { _token: csrf, conversation_id: conversation_id, body: body });
		posting.done(function(data) {
			if(data !== 'OK') {
				alert('Įvyko klaida siunčiant žinutę. Pabandykite šiek tiek vėliau.');
			} else {
				$form.find( "textarea[name='body']" ).val('').trigger('autosize');
			}
		});
	},
	_onMessage: function(data) {
		if(data.conversation_id == this.id) {
			var $container = this.$el.find('#messages-container');
			if($container.length) {
				$container.prepend(data.body);
				this._emojify();
				if(auth_id != data.user_id) {
					$.get('/pokalbiai/'+data.conversation_id+'/'+data.message_id+'/perskaityta');
				}
			}
		}
	},
	_emojify: function() {
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
	},
	_keyUpMessage: function(e) {
		var $form = this.$el.find('#send-message');
		if(e.keyCode == 13 && !e.shiftKey) {
			$form.submit();
			$(e.currentTarget).trigger('autosize:update');
		}
	}
});

module.exports = Conversation;