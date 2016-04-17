var Backbone = require('backbone');
var Conversation = require('./Conversation');

/**
 * Pokalbių manageris.
 */
var Conversations = Backbone.View.extend({
	'el': '#the-content',
	'active': {},
	'events': {
		'click #all-conversations': '_showAllConversations',
		'click #new-conversation': '_newConversation'
	},
	initialize: function() {
		var $conversation = this.$el.find('.active-conversation');
		if($conversation.length) {
			this.active_id = $conversation.data('conversation-id');
			this.active = new Conversation(this.active_id);
		}
		this._bindEvends();
	},
	_showAllConversations: function() {
		var $container = $('#all-conversations-container');
		$container.find('#all-conversations-body').html($('#conversations').html());
		$container.modal('show');
	},
	_newConversation: function() {
		$('#all-conversations-container').modal('hide');
		$('#create-conversation-container').modal('show');
	},
	_bindEvends: function() {
		var self = this;
		socket.on('messages', function(data) {
			self._onMessage(data);
		});
	},
	_onMessage: function(data) {
		if(data.conversation_id != this.active_id) {
			console.log('if passed');
			var $indicator = this.$el.find('#conversation-indicator-'+data.conversation_id);
			$indicator.find('span').attr('title', 'Yra naujų pranešimų').attr('data-original-title', 'Yra naujų pranešimų').data('original-title', 'Yra naujų pranešimų');
			$indicator.find('i').removeClass('fa-comments-o').removeClass('fa-grey').addClass('fa-comments').addClass('fa-primary');
		}
	}
});

module.exports = Conversations;