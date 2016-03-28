/**
 * Pranesimu controlleris.
 */

var Backbone = require('backbone');
var NotificationsService = require('./../services/Notifications');

var Notifications = Backbone.View.extend({

	events: {
		"click .action-mark-read-notification": "_markAsRead",
		"click .action-mark-read-notifications": "_markAllAsRead"
	},

	initialize: function() {

	},

	_markAsRead: function(e) {
		e.preventDefault();
		$target = $(e.currentTarget);
		var id = $target.data('id');
		console.log('click '+id);
		NotificationsService.markAsRead(id).success(function() {

		});
	},

	_markAllAsRead: function() {
		e.preventDefault();
		console.log('click all');
		NotificationsService.markAllAsRead().success(function() {
			
		});
	}

});

module.exports = Notifications;