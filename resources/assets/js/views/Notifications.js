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
		var self = this;

		e.preventDefault();
		var $target = $(e.currentTarget);		
		NotificationsService.markAsRead($target.data('id')).success(function() {
			$('.notification-item-'+$target.data('id')).removeClass('notification-unread');
			var $container = $('.user-notifications-icon span');
			var currentCount = $container.text();
			var shouldBe = parseInt(currentCount) - 1;
			$container.text(shouldBe);
			$target.remove();
			$('.tooltip').remove();
			self._toggleNotifications();
		});
	},

	_markAllAsRead: function(e) {
		var self = this;

		e.preventDefault();
		NotificationsService.markAllAsRead().success(function() {
			$('.user-notifications-icon span').text(0);
			$('.notification-list-item').removeClass('notification-unread');
			self._toggleNotifications();
		});
	},

	_toggleNotifications: function() {
		var $container = $('.user-notifications-icon span');
		if(parseInt($container.text()) > 0) {
			$container.show();
		} else {
			$container.hide();
		}
	}

});

module.exports = Notifications;