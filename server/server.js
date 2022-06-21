var https = require('https');
var http = require('http');
var express = require('express');
var app = express();
const fs = require('fs');
const options = {
  key: fs.readFileSync('/home/ksacab/ssl/keys/d7cbd_32b8b_48c720313733ee74c98bb31d72cc6e88.key'),
  cert: fs.readFileSync('/home/ksacab/ssl/certs/ksa_cab_cab_d7cbd_32b8b_1663027199_5552b563877e659042d72d96e86d8dca.crt')
};

var httpsServer = https.createServer(options,app);
var httpServer = http.createServer();

var io = require('socket.io',{ origins: "https://eduglobale.com:* http://eduglobale.com:*"})(httpsServer,httpServer);
var Redis = require('ioredis');
var redis = new Redis();
var mobData;
var driver_id;
// Server
io.on('connection', function (socket) {
    console.log("read");
  socket.on('update_location', function (data) {
    console.log(data , typeof data);
    
    if (data !== null && data.length > 0) { 
    // mobData = data;
    var data = JSON.parse(data);
    // driver_id = data.driver_id;
    mobData = {driver_id:data.driver_id,lat:data.lat,lng:data.lng,speed:data.speed,angle:data.angle};

     console.log(data);
      // data = data.map(({ lat, lng, driver_id , angle }) => ({ lat: parseFloat(lat), lng: parseFloat(lng), driver_id: parseInt(driver_id), angle: parseFloat(angle) }));
    io.emit('father_student.'+data.driver_id, mobData);
    socket.broadcast.emit('father_student.'+data.driver_id, mobData);

    var newData = {event:"App\\Events\\UpdateDriverLocationEvent",data:data};
    redis.publish('update_location',JSON.stringify(newData));
    
    socket.broadcast.emit('update_location', data);
    io.emit('update_location', data);
  }

  // var myTimer = setTimeout(sendMobile,4000);
  });
  
  // function sendMobile() {
  //   console.log("mobile" , mobData , "driver" , driver_id);
  //   io.emit('father_student.'+driver_id, mobData);
  //   socket.broadcast.emit('father_student.'+driver_id, mobData);
  // }

  socket.on('connect_timeout', function (data) {
      console.log(data)
    io.emit('driver_disconnect',data);
    
    socket.broadcast.emit('driver_disconnect',data);
  });
});
 

httpsServer.listen(3000, function () {
  console.log('listening on https://localhost:3000');
});

httpServer.listen(3001, function () {
  console.log('listening on http://localhost:3001');
});
