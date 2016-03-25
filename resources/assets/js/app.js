/**
 * Inicijavimas.
 */
var init = require('./init');
init();

var Backbone = require('backbone');
var SocketIO = require('socket.io-browserify');
var Sidebar = require('./views/Sidebar');
var Status = require('./views/Status');
var Topic = require('./views/Topic');
var Voter = require('./services/Voter');
var Progress = require('nprogress');
var Pjax = require('pjax');

var App = Backbone.View.extend({

	el: "#the-content",

	events: {
		"click .toggle-sidebar": "toggleSidebar",
		"click .vote-action": "_vote"
	},

	initialize: function() {
		this.views = {};
		this.views.topics = [];
		this.views.statuses = [];
		this.pjax = new Pjax({ 
			elements: ['a'],
			selectors: ["title", "#the-content"]
		});

		/**
		 * Sukuriam socketa.
		 */
		// var full_url = window.location.href;
		// var arr = full_url.split("/");
		// this.socket_url = arr[0]+'//'+window.location.host+':6001';
		// this.socket = SocketIO.connect(this.socket_url);

		this._createElements();
		this._onGetNextPage();
		this._onCompleteNextPage();
	},

	toggleSidebar: function() {
		this.views.sidebar.toggleSidebar();
	},

	_onGetNextPage: function() {
		$(document).on('pjax:send', function() { 
			Progress.start(); 
		});
	},

	_onCompleteNextPage: function() {
		var self = this;

		$(document).on('pjax:complete',   function() { 
			Progress.done();
			self._createElements();
		});
	},

	/**
	 * Sukuriam pagrindinius puslapio elementus
	 */
	_createElements: function() {
		var that = this;

		$('.main-sidebar').each(function(){
			that.views.sidebar = new Sidebar();
		});

		$('.topic-item').each(function() {
			that.views.topics.push(new Topic());
		});

		$('.topic-show').each(function() {
			that.views.topic = new Topic();
		});

		$('.status-show').each(function() {
			that.view.statuses.push(new Status());
		});

		$('.status-show-page').each(function() {
			this.views.status = new Status();
		});
	},

	_vote: function(e) {
		Voter.vote($(e.currentTarget));
	}
});

/**
 * Paleidziam client-side app
 */
$(document).ready(function() {
	new App();
});
