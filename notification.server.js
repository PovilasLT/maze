/**
 * TODO:
 * 1. Perkelti Notification serveri i atskira repo.
 * 2. Sutvarkyti bendra struktura. Isskaidyti i atskirus failus/servisus.
 */

var lex = require('letsencrypt-express');
var express = require('express');
var app = express();
var redisConfig = require('./redis.json');

var servers = lex.create({
	configDir: '/etc/letsencrypt',
	onRequest: app,
}).listen([], [6001], function onListening() {
	console.log("SERVERIS IJUNGTAS!");
});

var io = require('socket.io')(servers.tlsServers[0]);
var Redis = require('ioredis');
var redis = new Redis({
	password: redisConfig.password
});
var redisServer = new Redis({
	password: redisConfig.password
});
var Imagemin = require('imagemin');
var path = require('path');

app.use(function (req, res, next) {
    res.setHeader('Access-Control-Allow-Origin', 'https://maze.lt');
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST', 'PATCH', 'PUT', 'DELETE');
    res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type');
    res.setHeader('Access-Control-Allow-Credentials', true);
    next();
});

app.get('/', function (req, res) {
  res.send('...');
});

redis.psubscribe('*', function(err, count) {
	if(err) console.log(err);
});

redis.on('pmessage', function(subscribed, channel, event) {
    event = JSON.parse(event);
	io.sockets.in(event.data.channel).emit(channel, event.data.data);
});

/**
 * Kiekvienas connection turi savo scope.
 * Viskas, kas yra connection funkcijoje yra kuriama atskirai kiekvienam socketo prisijungimui.
 * Potencialiai gali valgyti daug atminties.
 */
io.sockets.on('connection', function (socket) {
	var secret;

	// Prisijungimas į savo secret kanalą.
	socket.on('join', function(channel) {
		secret = channel;
		socket.join(channel);
		redisServer.sadd('online_users', secret);
	});

	socket.on('disconnect', function() {
		redisServer.srem('online_users', secret);
	});
});