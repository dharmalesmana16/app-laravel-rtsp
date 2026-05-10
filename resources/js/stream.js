import rtspStream from 'node-rtsp-stream'
//@desc     Camera Authentication
var ip_address = "116.66.205.182" //NOTE: replace it with your camera IP address

//@desc     Camera username and password


//@desc   

// app.get("/stream")
let data = [
  {
    "username":"admin_it",
    "password":"qwerty96",
    "ip_address":"116.66.205.182",
    "channel":"10",
    "port":8010,
  },
  {
    "username":"admin_it",
    "password":"qwerty96",
    "ip_address":"116.66.205.182",
    "channel":"11",
    "port":8011,
  },
  {
    "username":"admin_it",
    "password":"qwerty96",
    "ip_address":"116.66.205.182",
    "channel":"12",
    "port":8012,
  },
  {
    "username":"admin_it",
    "password":"qwerty96",
    "ip_address":"116.66.205.182",
    "channel":"13",
    "port":8013,
  },
  {
    "username": "admin_it",
    "password": "qwerty96",
    "ip_address": "116.66.205.182",
    "channel": "14",
    "port": 8014,
},
{
    "username": "admin_it",
    "password": "qwerty96",
    "ip_address": "116.66.205.182",
    "channel": "15",
    "port": 8015,
},
{
    "username": "admin_it",
    "password": "qwerty96",
    "ip_address": "116.66.205.182",
    "channel": "16",
    "port": 8016,
},
{
    "username": "admin_it",
    "password": "qwerty96",
    "ip_address": "116.66.205.182",
    "channel": "19",
    "port": 8019,
},
]
var username = "admin_it";
var password="qwerty96";
data.forEach((element, index) => {
  let stream = new rtspStream({
    name: 'name',
    streamUrl: 'rtsp://' + element["username"] + ':' + element["password"] + '@' + element["ip_address"] +`:554/cam/realmonitor?channel=${element["channel"]}&subtype=1`,
    wsPort: `${element["port"]}`,
    
});
stream.on('message', (message) => {
  console.log(`Received: ${message}`);
  // Send a response back to the client
  stream.send(`hai`);
});
})

   
// streamThird = new rtspStream({
//     name: 'name',

//     streamUrl: 'rtsp://' + username + ':' + password + '@' + ip_address +':554/cam/realmonitor?channel=12&subtype=1',
//     wsPort: 8082 
// });
// streamThird = new rtspStream({
//     name: 'name',

//     streamUrl: 'rtsp://' + username + ':' + password + '@' + ip_address +':554/cam/realmonitor?channel=13&subtype=1',
//     wsPort: 8083 
// });
// streamThird = new rtspStream({
//     name: 'name',

//     streamUrl: 'rtsp://' + username + ':' + password + '@' + ip_address +':554/cam/realmonitor?channel=14&subtype=1',
//     wsPort: 8084 
// });
// streamThird = new rtspStream({
//     name: 'name',

//     streamUrl: 'rtsp://' + username + ':' + password + '@' + ip_address +':554/cam/realmonitor?channel=15&subtype=1',
//     wsPort: 8085
// });
// streamThird = new rtspStream({
//     name: 'name',

//     streamUrl: 'rtsp://' + username + ':' + password + '@' + ip_address +':554/cam/realmonitor?channel=15&subtype=1',
//     wsPort: 8086
// });