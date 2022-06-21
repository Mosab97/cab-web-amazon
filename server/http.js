var https = require('https');
const querystring = require('querystring');
var express = require('express');
var app = express();
const fs = require('fs');
const options = {
    cert: fs.readFileSync('/home/ksacab/ssl/certs/ksa_cab_cab_d7cbd_32b8b_1663027199_5552b563877e659042d72d96e86d8dca.crt'),
    key: fs.readFileSync('/home/ksacab/ssl/keys/d7cbd_32b8b_48c720313733ee74c98bb31d72cc6e88.key')
    
};
var http_options = {
    host: "ksa-cab.cab",
    path: "/api/update_location",
    method: "POST",
    rejectUnauthorized: false,
    headers: {
        // 'Content-Type': 'application/x-www-form-urlencoded',
        // 'Content-Length': Buffer.byteLength(post_data)
    }

}
// var whisper_options = {
//     host: "caberz-apps.com",
//     port:6009,
//     path: "/apps/d4c3f1c3096ce412/events",
//     method: "POST",
//     rejectUnauthorized: false,
//     headers: {
//         // 'Content-Type': 'application/x-www-form-urlencoded',
//         // 'Content-Length': Buffer.byteLength(post_data)
//     }
//
// }
var httpsServer = https.createServer(options, app);

var io = require('socket.io')(httpsServer, { 'cors': { 'methods': ['GET', 'PATCH', 'POST', 'PUT'], 'origin': true ,'credentials': true} });
var drivers_data = [];
// var whisper_drivers_data = [];
// var whisper_event = {};
// process.env["NODE_TLS_REJECT_UNAUTHORIZED"] = 0;
// To whisper
// whisper_event['channel'] = "private-caberz-update-location.driver";
// whisper_event['name'] = "client-moving";
// whisper_event['data'] = {};
// Server
io.on('connection', function(socket) {
    console.log("read");
    var timer = 0;
    socket.on('update_location', function(data_mob) {
            // console.log(Object.keys(data_mob).length > 0 , 'updated',timer);
            if (data_mob !== null && Object.keys(data_mob).length > 0) {
            var data;
            if (typeof data_mob === 'object') {
                data = data_mob;
            } else {
                data = JSON.parse(data_mob);
            }
            // console.log(data);

            // for (var i = 0; i < whisper_drivers_data.length; i++) {
            //
            //     if (whisper_drivers_data[i].data.length > 0 && whisper_drivers_data[i].data.driver_id == data.driver_id && data.lat > 1 && data.lng > 1) {
            //         whisper_drivers_data[i].data.lat = data.lat;
            //         whisper_drivers_data[i].data.lng = data.lng;
            //         whisper_drivers_data[i].data.speed = data.speed;
            //         whisper_drivers_data[i].data.angle = data.angle;
            //         break;
            //     }
            // }
            // var new_item = whisper_drivers_data.find((item , j) => {
            //     if (item.data.length > 0 && item.data.driver_id == data.driver_id) {
            //         return true;
            //     }
            // });
            // if (new_item != true && data.driver_id && data.lat > 1 && data.lng > 1) {
            //     var new_obj = {};
            //     new_obj['driver_id'] =  data.driver_id ;
            //     new_obj['lat'] =  data.lat ;
            //     new_obj['lng'] = data.lng;
            //     new_obj['speed'] = data.speed;
            //     new_obj['angle'] = data.angle;
            //     whisper_event['data'] = new_obj;
            //     whisper_drivers_data.push(whisper_event);
            // }
            // if (data.lat > 1 && data.lng > 1) {
            //     var new_obj = {};
            //     new_obj['driver_id'] =  data.driver_id ;
            //     new_obj['lat'] =  data.lat ;
            //     new_obj['lng'] = data.lng;
            //     new_obj['speed'] = data.speed;
            //     new_obj['angle'] = data.angle;
            //     whisper_event['data'] = new_obj;
            //
            //     var whisper_data = JSON.stringify(whisper_event);
            //     whisper_options.headers = {
            //         'Content-Type': 'application/json',
            //         'Authorization': 'Bearer 482b47070879b391fa26017849c3cc32',
            //         'Content-Length': Buffer.byteLength(whisper_data)
            //     }
            //
            //     const whisper_request = https.request(whisper_options, (res) => {
            //         // console.log(`STATUS: ${res.statusCode}`);
            //         res.setEncoding('utf8');
            //         res.on('data', (chunk) => {
            //             // console.log(`BODY: ${chunk}`);
            //         });
            //
            //         res.on('end', () => {
            //             // console.log(whisper_data);
            //         });
            //
            //     });
            //
            //
            //     whisper_request.on('error', (e) => {
            //         console.error(`problem with request: ${e.message}`);
            //     });
            //     whisper_request.write(whisper_data);
            //     whisper_request.end();
            // }

            // End Whisper
            for (var i = 0; i < drivers_data.length; i++) {
                if (drivers_data[i].driver_id == data.driver_id && data.driver_id && data.lat > 1 && data.lng > 1) {
                    drivers_data[i].lat = data.lat;
                    drivers_data[i].lng = data.lng;
                    drivers_data[i].type = data.type;
                    drivers_data[i].device_token = data.token;
                    break;
                }
            }

            if (drivers_data.filter(x => x.driver_id == data.driver_id).length === 0 && data.driver_id && data.lat > 1 && data.lng > 1) {
                var new_obj = {};
                new_obj['driver_id'] =  data.driver_id ;
                new_obj['lat'] =  data.lat ;
                new_obj['lng'] = data.lng;
                new_obj['type'] = data.type;
                new_obj['device_token'] = data.token;
                drivers_data.push(new_obj);
            }
            // console.log(drivers_data);
        }

    });
});


setInterval(() => {

    if (drivers_data.length > 0) {
        var mapData = {};
        mapData['drivers'] = JSON.stringify(drivers_data);

        const post_data = querystring.stringify(mapData);

        http_options.headers = {
            'Content-Type': 'application/x-www-form-urlencoded',
            'Content-Length': Buffer.byteLength(post_data)
        }
        const request = https.request(http_options, (res) => {
            // console.log(`STATUS: ${res.statusCode}`);
            res.setEncoding('utf8');
            res.on('data', (chunk) => {
                // console.log(`BODY: ${chunk}`);
            });
            res.on('end', () => {
                drivers_data = [];
                mapData = {};
            });
        });


        request.on('error', (e) => {
            console.error(`problem with request: ${e.message}`);
        });
        request.write(post_data);
        request.end();
    }

}, 20000);

// setInterval(() => {
//     if (whisper_drivers_data.length > 0) {
//         whisper_drivers_data.forEach((item, i) => {
//             // item.data = querystring.stringify(item.data);
//         if (item.data.length > 0 && item.data.lat > 1 && item.data.lng > 1) {
//
//
//             var whisper_data = JSON.stringify(item);
//             whisper_options.headers = {
//                 'Content-Type': 'application/json',
//                 'Authorization': 'Bearer 482b47070879b391fa26017849c3cc32',
//                 'Content-Length': Buffer.byteLength(whisper_data)
//             }
//
//             const whisper_request = https.request(whisper_options, (res) => {
//                 // console.log(`STATUS: ${res.statusCode}`);
//                 res.setEncoding('utf8');
//                 res.on('data', (chunk) => {
//                     // console.log(`BODY: ${chunk}`);
//                 });
//
//                 res.on('end', () => {
//                     // console.log(whisper_data);
//                 });
//
//             });
//
//
//             whisper_request.on('error', (e) => {
//                 console.error(`problem with request: ${e.message}`);
//             });
//             whisper_request.write(whisper_data);
//             whisper_request.end();
//         }
//         });
//         whisper_drivers_data = [];
//         whisper_data = "";
//
//     }
//
// }, 2000);


httpsServer.listen(3001, function() {
    console.log('listening on https://localhost:3001');
});
