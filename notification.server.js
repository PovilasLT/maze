var app = require('http').createServer(handler);
var io = require('socket.io')(app);
var Redis = require('ioredis');
var redis = new Redis();

redis.subscribe('notifications', function(err, count) {

});

redis.on('message', function(channel, message) {
   console.log('Message Recieved: ' + message);

    message = JSON.parse(message);

    io.emit(channel + ':' + message.event, message.data);

});

app.listen(6001, function() {
    console.log('Server is running!');
});