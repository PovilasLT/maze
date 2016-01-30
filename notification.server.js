var lex = require('letsencrypt-express');
var express = require('express');
var app = express();
var server = require('https').Server(app);
var io = require('socket.io')(server);
var Redis = require('ioredis');
var redis = new Redis();
var Imagemin = require('imagemin');
var path = require('path');

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

app.get('/', function (req, res) {
	res.send('...');
});

io.sockets.on('connection', function (socket) {
  socket.on('join', function (data) {
    socket.join(data.id + '-' + data.secret);
  });
});

lex.create({
	configDir: '/etc/letsencrypt',
	onRequest: app,
	letsencrypt: null
}).listen([], [6001], function () {
  console.log("SERVERIS IJUNGTAS!");
});