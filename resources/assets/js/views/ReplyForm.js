var Backbone = require('backbone');

var ReplyForm = Backbone.View.extend({

	el: ".create-form-wrapper",

	initialize: function() {
		this.resize();
	},

	affix: function() {
		$(this.el).affix({
			offset: {
				bottom: function() {
					return parseInt($('footer').outerHeight(true)) + 40;
				}
			}
		});
	},

	resize: function() {		
		var that = this;
		var $reply_form_fix = $('.reply-form-fix');

		setInterval(function() {
			$reply_form_fix.height($(that.el).height());
			that.affix();
		}, 50);

	}

});

module.exports = ReplyForm;