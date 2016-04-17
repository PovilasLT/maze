/**
 * Socket.IO wrapperis.
 * Wrapperis pravers jeigu kada netyčia norėsim keisti socketų implementaciją.
 * Plius darom daug tikrinimų susijusių su socketo adresu.
 */

var SocketIO = require('socket.io-client');

var Socket = function(token) {
	this.protocol = this.getProtocol();
	this.domain = this.getDomain();
	this.port = this.getPort();
	this.token = token;
	this.socketIO = SocketIO.connect(this.getConnectionUri());
	this.socketIO.emit('join', token);
};

/**
 * Randa dabartinio URL protokolą (HTTP|HTTPS)
 * @return {String} http|https
 */
Socket.prototype.getProtocol = function() {
	var arr = window.location.href.split("/");
	return arr[0].replace(/:/ig,'');
};

/**
 * Patikrina ar dabartinis protokolas yra SSL.
 * @return {Boolean}
 */
Socket.prototype.isSSL = function() {
	if(this.protocol.toLowerCase() === 'http') {
		return false;
	} else {
		return true;
	}
};

/**
 * Gražina domeną.
 * @return {String} maze.lt|tv.maze.lt|maze.app
 */
Socket.prototype.getDomain = function() {
	return window.location.host;
};

/**
 * Maze palaiko HTTPS ir HTTP socketus.
 * HTTPS - 6001
 * HTTP - 6002
 * @return {int} 6001|6002
 */
Socket.prototype.getPort = function() {
	if(this.isSSL()) {
		return 6001;
	} else {
		return 6002;
	}
};

/**
 * Sukuria ir gražina prisijungimo URL.
 * @return {String} socketo adresas (pvz.: http://maze.lt:6000)
 */
Socket.prototype.getConnectionUri = function() {
	var uri = this.getProtocol()+'://'+this.getDomain()+':'+this.getPort();
	return uri;
};

/**
 * Siunčia duomenis į vartotojo kanalą.
 * @param  {Object} data duomenų objektas. Pageidautina, kad būtų objektas, bet nebūtina.
 */
Socket.prototype.send = function(data) {
	this.socketIO.on(this.secret).emit(data);
};

Socket.prototype.on = function(type, cb) {
	this.socketIO.on(type, cb);
};

Socket.prototype.leave = function() {
	this.socketIO.emit('leave', this.token);
};

module.exports = Socket;