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

module.exports = new Notifications();