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
  res.send('NOTIFICATIONS');
});

redis.psubscribe('*', function(err, count) {
});

redis.on('pmessage', function(subscribed, channel, event) {
    event = JSON.parse(event);
	if(event.event == 'maze\\Events\\AvatarWasUploaded')
	{
		var dest = path.dirname(event.data.path);
		new Imagemin()
		.use(Imagemin.optipng({optimizationLevel: 3}))
		.src(event.data.path)
		.dest(dest)
		.run(function(err, files) {
			if(err)
				console.log(err);
		});
	}
	else
	{
	    io.sockets.in(event.data.channel).emit('message', event.data.message);
	}
});

io.sockets.on('connection', function (socket) {
  socket.on('join', function (data) {
    socket.join(data.id + '-' + data.secret);
  });
});