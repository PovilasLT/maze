var Backbone = require('backbone');
var _ = require('underscore');
var notification_template = require('./../templates/notification.template.html');

var NotificationsPopover = Backbone.View.extend({
	
	events: {
		'click #the-content': '_addNotification'
	},
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
			placement: "bottom"
		});
	},

	/**
	 * Prideda naują notification objektą į popoverį.
	 * @param {Notification} notification notification objektas gautas iš socketo.
	 */
	addNotification: function(notification) {
		var $items = $('.notification-list-item');
		
		if($items.length >= 5) {
			$items.last().remove();
		}

		$('.notification-list').prepend(_.template(notification_template)({notification: notification}));
	},
});

module.exports = NotificationsPopover;