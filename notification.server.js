var app = require('http').createServer(function (req, res) {
	res.writeHead(200, { 'Content-Type': 'text/html' });
	res.end('<img src="https://s-media-cache-ak0.pinimg.com/736x/8b/e0/f8/8be0f8dd6d4a6ee1325c6d46297dd46e.jpg"></img>');
});
var io = require('socket.io')(app);
var Redis = require('ioredis');
var redis = new Redis();

redis.psubscribe('*', function(err, count) {
});

redis.on('pmessage', function(subscribed, channel, event) {
    event = JSON.parse(event);
    io.sockets.in(event.data.channel).emit('message', event.data.message);
    // io.emit(channel + ':' + message.event, message.data);
});

io.sockets.on('connection', function (socket) {
  socket.on('join', function (data) {
    socket.join(data.id + '-' + data.secret); // We are using room of socket io
  });
});

app.listen(6001, function() {
    console.log('SERVERIS IJUNGTAS');
});