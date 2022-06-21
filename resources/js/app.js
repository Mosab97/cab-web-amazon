import Echo from "laravel-echo"

window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6009'
});
window.cars = [];

require('./chat');
require('./notification');
if (window.Data.chat_id != null) {

    window.connectToChat(window.Data.chat_id);
}
require('./move');
