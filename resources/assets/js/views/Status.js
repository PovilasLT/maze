var Backbone = require('backbone');
var emojify = require('emojify.js');

var Status = Backbone.View.extend({

	events: {
		"click .show-status-comments": "toggleStatusComments" 
	},

	initialize: function() {
		console.log('init status');
		this.views = {};
		this.body = $('.topic-content');
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
		emojify.run();
	},

	toggleStatusComments: function(e) {
		var current = e.currentTarget;
		var status_id = current.attr('status-id');

		if(current.hasClass('active'))
		{
			$('#comments-'+status_id).slideUp();
			current.removeClass('active');
		}
		else
		{
			$('#comments-'+status_id).slideDown();
			current.addClass('active');
		}
	}

});

module.exports = Status;