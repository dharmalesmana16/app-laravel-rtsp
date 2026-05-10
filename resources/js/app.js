import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

let data = [{
    "username": "admin",
    "password": "x0121oke",
    "ip_address": "116.66.205.182",
    "channel": "10",
    "port": 8010,
},
{
    "username": "admin",
    "password": "x0121oke",
    "ip_address": "116.66.205.182",
    "channel": "11",
    "port": 8011,
},
{
    "username": "admin",
    "password": "x0121oke",
    "ip_address": "116.66.205.182",
    "channel": "12",
    "port": 8012,
},
{
    "username": "admin",
    "password": "x0121oke",
    "ip_address": "116.66.205.182",
    "channel": "13",
    "port": 8013,
},
{
    "username": "admin",
    "password": "x0121oke",
    "ip_address": "116.66.205.182",
    "channel": "14",
    "port": 8014,
},
{
    "username": "admin",
    "password": "x0121oke",
    "ip_address": "116.66.205.182",
    "channel": "15",
    "port": 8015,
},
{
    "username": "admin",
    "password": "x0121oke",
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
data.forEach((element, index) => {
    
    var player = new jsmpeg(new WebSocket(`ws://localhost:${element["port"]}`), {
        canvas: document.getElementById(`chanel${index}`),
        autoplay: true,
        loop: true,
    })
    // player.onopen = (event) => {
    //     console.log("Connected to server!");
    //   };
})

Alpine.start();
