/**
 * Inicijavimas.
 */
var init = require('./init');
init();

/**
 * Globalus socket.
 */
var Socket = require('./services/Socket');
global.socket = new Socket(token);

/**
 * Priklausomybės.
 */
var Backbone = require('backbone');
var Sidebar = require('./views/Sidebar');
var Status = require('./views/Status');
var Topic = require('./views/Topic');
var Voter = require('./services/Voter');
var Notifications = require('./views/Notifications');
var Progress = require('nprogress');
var Pjax = require('pjax');
/**
 * Pagrindinis app.
 * Naudojamas paprastas Backbone View, kaip containeris visai aplikacijai.
 */
var App = Backbone.View.extend({

	el: "body",
	views: {
		topics: [],
		statuses: [],
	},
	events: {
		"click .toggle-sidebar": "toggleSidebar",
		"click .vote-action": "_vote"
	},

	/**
	 * Paleidžiam pagrindines app'o funkcijas.
	 */
	initialize: function() {
		this.pjax = new Pjax({ 
			elements: ['a'],
			selectors: ["title", "#the-content"]
		});
		this._createElements();
		this._onGetNextPage();
		this._onCompleteNextPage();
	},

	/**
	 * Šoninės panelės junginėmijas mobiliuosiuose prietaisuose.
	 */
	toggleSidebar: function() {
		this.views.sidebar.toggleSidebar(); //kreipiasi tiesiai į kitą view ir jo funkciją.
	},

	/**
	 * Vykdoma, kai lankytojas paspaudžia nuorodą į kitą puslapį sistemoje.
	 */
	_onGetNextPage: function() {
		$(document).on('pjax:send', function() { 
			Progress.start(); 
		});
	},

	/**
	 * Vykdoma, kai vartotojas pereina į kitą puslapį.
	 */
	_onCompleteNextPage: function() {
		var self = this;

		$(document).on('pjax:complete',   function() { 
			Progress.done();
			self._cleanUp();
			self._createElements();
			init();
		});
	},

	/**
	 * Sukuriam pagrindinius puslapio elementus.
	 * Puslapyje gali egzistuoti ne visi elementai.
	 * Gal ir ne pats geriausias sprendimas, bet manau su laiku bus tobulinama.
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

		this.views.notifications = new Notifications();
	},

	/**
	 * Balsavimas
	 * @param  {Event} e click'o eventas.
	 */
	_vote: function(e) {
		Voter.vote($(e.currentTarget));
	},

	/**
	 * Išvalom visus views.
	 * Reikalinga, kad tie patys views nepasiliktų perėjus į kitą puslapį ir neužkištų atminties.
	 */
	_cleanUp: function() {
		this.views = {};
		this.views.topics = [];
		this.views.statuses = [];
	},

	_notificationMarkAsRead: function() {
		Notifications.markAsRead();
	},

	_notificationsMarkAsRead: function() {
		Notifications.markAllAsRead();
	}
});

/**
 * Paleidziam client-side app.
 * Paleidimas vyksta tik tada, kai puslapis būna ready ir visi jame esantys elementai jau egzistuoja.
 */
$(document).ready(function() {
	new App();
});
