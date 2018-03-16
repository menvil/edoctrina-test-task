var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
require('dotenv').config();

http.listen(process.env.NODE_SERVER_PORT, function(){
    console.log('Listening on Port '+process.env.NODE_SERVER_PORT);
});


io.on('connection', function(socket){
    socket.on('change', function(jsonString){
        socket.broadcast.emit('quiz-channel'+JSON.parse(jsonString).quiz+':change', JSON.stringify(JSON.parse(jsonString).data));
    });

    socket.on('finish', function(jsonString){
        socket.broadcast.emit('quiz-channel'+JSON.parse(jsonString).quiz+':finish', 'finish');
    });
});
