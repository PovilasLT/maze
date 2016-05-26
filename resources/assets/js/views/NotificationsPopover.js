var Backbone = require('backbone');
var _ = require('underscore');
var notification_template = require('./../templates/notification.template.html');
var NotificationsService = require('./../services/Notifications');

var NotificationsPopover = Backbone.View.extend({
	
	el: '#notifications-container',

	initialize: function() {
		var self = this;

		$('.notifications').popover({
			animation: true,
			container: "#the-content",
			content: function() {
				return self.$el.html();
			},
			html: true,
			title: function() {
				return null;
			},
			placement: "bottom"
		});

		this._notificationListener();
	},

	_notificationListener: function() {
		var self = this;

		socket.on('data', function(notification) {
			self._addNotification(notification);
		});
	},

	/**
	 * Prideda naują notification objektą į popoverį.
	 * @param {Notification} notification notification objektas gautas iš socketo.
	 */
	_addNotification: function(notification) {
		var $items = $('.notification-list-item');
		
		if($items.length >= 5) {
			$items.last().remove();
		}

		$('.notification-list').prepend(_.template(notification_template)({notification: notification}));
		NotificationsService.increment();
	},
});

module.exports = NotificationsPopover;