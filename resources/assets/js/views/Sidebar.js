var Backbone = require('backbone');
var _ = require('underscore');
var User = require('./User');
var NotificationsPopover = require('./NotificationsPopover');

var Sidebar = Backbone.View.extend({

	el: '.main-sidebar',
	views: {},
	events: {
		"click .parent-icon": "toggleNode",
		"click .toggle-front-page-node": "toggleFrontPageNode",
		"click .edit-front-page-nodes": "editFrontPageNodes",
		"click .notifications": "showNotifications"
	},

	initialize: function() {
		this.views.NotificationsPopover = new NotificationsPopover();
		this._initNodes();
		this._notifications();
	},

	toggleSidebar: function(e) {
		var main_content = $('.main-content');
		var main_sidebar = $('.main-sidebar');
		var footer = $('footer');

		if(main_content.hasClass('is_visible')) {
			footer.hide();
			main_content.slideUp('', function() {
				main_sidebar.removeClass('hidden-xs').removeClass('hidden-sm');
				footer.show();
			}).removeClass('is_visible');
		}
		else {
			footer.hide();
			main_content.slideDown('', function() {
				main_sidebar.addClass('hidden-xs').addClass('hidden-sm');
				footer.show();
			}).addClass('is_visible');
		}
	},

	toggleNode: function(e) {
		var current = $(e.currentTarget);
		var id = current.attr('id');

		if(!current.hasClass('expanded'))
		{
			$('.parent-node-collection-'+id).slideDown('fast');
			current.addClass('expanded')
			.removeClass('fa-plus')
			.addClass('fa-minus');
		}
		else 
		{
			$('.parent-node-collection-'+id).slideUp('fast');
			current.removeClass('expanded')
			.removeClass('fa-minus')
			.addClass('fa-plus');
		}
	},

	editFrontPageNodes: function(e) {
		var edit_btn = $(e.currentTarget);
		var that = this;

		if(edit_btn.data('active')) {
			edit_btn.data('active', 0).css('color', '');
			$('.toggle-front-page-node').addClass('hidden');
		}
		else {
			edit_btn.data('active', 1).css('color', '#27AE60');
			$('.toggle-front-page-node').removeClass('hidden');				
		}

		$('.parent-icon').each(function() {
			that.toggleNode({"currentTarget": this});
		});

		e.preventDefault();
	},

	toggleFrontPageNode: function(e) {
		var target_node = $(e.currentTarget);
		$.ajax({
			url: $('.node-list').data('update-url'),
			method: 'post',
			dataType: 'json',
			data: {
				node_id: target_node.data('node'),
				state: target_node.is(':checked') ? 'on' : 'off'
			}
		});
	},

	_notifications: function() {
		var self = this;

		socket.on('notification', function(data) {
			self.views.NotificationsPopover.addNotification(data);
		});
	},

	_initNodes: function() {
		var is_expanded = $('.is-expanded .parent-icon');

		if(is_expanded.length)
		{
			var is_expanded_id = is_expanded.attr('id');
			is_expanded.addClass('expanded')
			.removeClass('fa-plus')
			.addClass('fa-minus');
			$('.parent-node-collection-'+is_expanded_id).slideDown('fast');
		}
	},

	showNotifications: function(e) {
		e.preventDefault();
	}
});

module.exports = Sidebar;