var lex = require('letsencrypt-express').testing();
var express = require('express');
var app = express();
var redisConfig = require('./redis.json');

var servers = lex.create({
	configDir: '/etc/letsencrypt',
	onRequest: app,
}).listen([6002], [6001], function onListening() {
	console.log("SERVERIS IJUNGTAS!");
});

var io = require('socket.io')(servers.plainServers[0]);
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
    res.setHeader('Access-Control-Allow-Origin', 'https://maze.app');
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST', 'PATCH', 'PUT', 'DELETE');
    res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type');
    res.setHeader('Access-Control-Allow-Credentials', true);
    next();
});

app.get('/', function (req, res) {
  res.send('NOTIFICATIONS');
});

redis.psubscribe('*', function(err, count) {
});

redis.on('pmessage', function(subscribed, channel, event) {
	console.log('message received');
    event = JSON.parse(event);
    console.log(subscribed);
    console.log(event);
    console.log(channel);
	if(channel == 'avatars') {
		var dest = path.dirname(event.data.path);
		new Imagemin()
		.use(Imagemin.optipng({optimizationLevel: 3}))
		.src(event.data.path)
		.dest(dest)
		.run(function(err, files) {
			if(err)
				console.log(err);
		});
	} else if(channel == 'notifications') {
		io.sockets.in(event.data.user.secret).emit('notification', event.data.notification);
	} else {
	    io.sockets.in(event.data.channel).emit('message', event.data.message);
	}
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
		if(channel.type == 'user') {
			console.log(channel.token + ' connected');
			secret = channel.token;
			redisServer.sadd('online_users', secret);
			socket.join(secret);
		} else if (channel.type == 'message') {
			console.log('joining message channel');

		}
	});

	socket.on('disconnect', function() {
		console.log(secret + 'disconnected');
		redisServer.srem('online_users', secret);
	});


	//TODO: Chat
	// socket.on('join', function (data) {
	// 	socket.join(data.id + '-' + data.secret);
	// });
});