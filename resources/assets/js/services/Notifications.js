var Notifications  = function() {

};

Notifications.prototype.markAsRead = function(id) {
	return $.get('/pranesimai/zymeti/pranesimas/'+id).error(function(data) {
		alert('Įvyko klaida. Pabandykite vėliau.');
	});
};

Notifications.prototype.markAllAsRead = function() {
	return $.get('/pranesimai/zymeti/visi').error(function(data) {
		alert('Įvyko klaida. Pabandykite vėliau.');
	});
};

Notifications.prototype.increment = function() {
	var $container = $('.user-notifications-icon span');
	var currentCount = $container.text();
	var shouldBe = currentCount ? parseInt(currentCount) + 1 : 1;
	$container.text(shouldBe);
	this.toggle();
};

Notifications.prototype.decrement = function() {
	var $container = $('.user-notifications-icon span');
	var currentCount = $container.text();
	var shouldBe = parseInt(currentCount) - 1;
	$container.text(shouldBe);
	this.toggle();
};

Notifications.prototype.clear = function() {
	$('.user-notifications-icon span').text(0);
	this.toggle();
};

Notifications.prototype.toggle = function() {
	var $container = $('.user-notifications-icon span');
	if(parseInt($container.text()) > 0) {
		$container.css('display', 'none');
	} else {
		$container.css('display', 'inline-block');
	}
};

module.exports = new Notifications();