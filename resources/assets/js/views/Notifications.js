/**
 * Pranesimu controlleris.
 */

var Backbone = require('backbone');
var NotificationsService = require('./../services/Notifications');

var Notifications = Backbone.View.extend({

	el: "body",
	events: {
		"click .action-mark-read-notification": "_markAsRead",
		"click .action-mark-read-notifications": "_markAllAsRead"
	},

	initialize: function() {
	},

	_markAsRead: function(e) {
		e.preventDefault();
		var $target = $(e.currentTarget);		
		NotificationsService.markAsRead($target.data('id')).success(function() {
			$('.notification-item-'+$target.data('id')).removeClass('notification-unread');
			$target.remove();
			$('.tooltip').remove();
			NotificationsService.decrement();
		});
	},

	_markAllAsRead: function(e) {
		e.preventDefault();
		NotificationsService.markAllAsRead().success(function() {
			$('.notification-list-item').removeClass('notification-unread');
			NotificationsService.clear();
		});
	}
});

module.exports = Notifications;