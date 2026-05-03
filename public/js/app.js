import rtspStream from 'node-rtsp-stream'; // Built-in module
i
//@desc     Camera Authentication
var ip_address = "116.66.205.182" //NOTE: replace it with your camera IP address

//@desc     Camera username and password
var username = "admin_it";
var password="qwerty96";

//@desc     A channel of camera stream
let stream = new rtspStream({
    name: 'name',

    streamUrl: 'rtsp://' + username + ':' + password + '@' + ip_address +':554/cam/realmonitor?channel=10&subtype=1',
    wsPort: 8000    
});