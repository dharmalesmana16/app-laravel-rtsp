import './bootstrap';
import Alpine from 'alpinejs';
import fetchWilayah from './api';
import  $  from "jquery";
import Swal from 'sweetalert2';
window.Swal = Swal
window.$ = $
window.Alpine = Alpine;
window.fetchWilayah = fetchWilayah
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
axios.get('http://localhost:8000/api/camera')
  .then(response => {
    // console.log(response.data.data)
    response.data.data.forEach((element, index) => {
    
        var player = new jsmpeg(new WebSocket(`ws://localhost:${element["http_port"]}`), {
            canvas: document.getElementById(`chanel${index}`),
            autoplay: true,
            loop: true,
        })
        // player.onopen = (event) => {
        //     console.log("Connected to server!");
        //   };
    })
})

  .catch(error => {
    console.error(error);
  });


// async function displayData() {
//     try {
//       // Await the exported fetch function
//       const user = await fetchWilayah();
//       console.log("User Data Received:", user);
//     } catch (error) {
//       console.log("Could not display data due to an error.");
//     }
//   }
//   displayData()
Alpine.start();
