var Backbone = require('backbone');
var Conversation = require('./Conversation');
var QueryStringParser = require('query-string-parser');

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
		this._shouldStart();
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
	/**
	 * Naujai atsiustos zinutes aptikimas bendrame pokalbiu pus
	 * @param  {Object} data zinutes duomenys.
	 */
	_onMessage: function(data) {
		if(data.conversation_id != this.active_id) {
			var $indicator = this.$el.find('#conversation-indicator-'+data.conversation_id);
			$indicator.find('span').attr('title', 'Yra naujų pranešimų').attr('data-original-title', 'Yra naujų pranešimų').data('original-title', 'Yra naujų pranešimų');
			$indicator.find('i').removeClass('fa-comments-o').removeClass('fa-grey').addClass('fa-comments').addClass('fa-primary');

			if(data.user_online) {
				var $online = this.$el.find('#user-status-'+data.user_id);
				$online.removeClass('fa-circle-o').removeClass('fa-grey').addClass('fa-circle').addClass('fa-primary').attr('data-original-title', 'Prisijungęs').data('original-title', 'Prisijungęs');
			}
		}
	},
	/**
	 * Patikrinam ar reikia pradeti nauja pokalbi.
	 */
	_shouldStart: function() {
		var query = window.location.href.split("?").slice(1).join("?");
		if(QueryStringParser.parseQuery(query)) {
			this._newConversation();
		}
	}
});

module.exports = Conversations;