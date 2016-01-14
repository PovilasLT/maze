var fs = require('fs');

var ssl_conf = require('./ssl.json');

var options = {
  key: fs.readFileSync(ssl_conf.key),
  cert: fs.readFileSync(ssl_conf.cert)
};

var app = require('https').createServer(function (req, res) {
	res.writeHead(200, { 'Content-Type': 'text/html' });
	res.end('<img src="https://s-media-cache-ak0.pinimg.com/736x/8b/e0/f8/8be0f8dd6d4a6ee1325c6d46297dd46e.jpg"></img>');
});
var io = require('socket.io')(app);
var Redis = require('ioredis');
var redis = new Redis();
var Imagemin = require('imagemin');
var path = require('path');

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

app.listen(6001, function() {
    console.log('SERVERIS IJUNGTAS');
});