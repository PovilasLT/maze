var Backbone = require('backbone');
var ReplyForm = require('./ReplyForm');

var Topic = Backbone.View.extend({
	initialize: function() {
		this.views = {};
		this.views = new ReplyForm();
	}
});

module.exports = Topic;