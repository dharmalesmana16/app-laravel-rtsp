// import * as Highcharts from 'highcharts'
// import HighchartsMore from 'highcharts/highcharts-more'
// import HighchartsSolidGauge from 'highcharts/modules/solid-gauge'
import 'leaflet/dist/leaflet.css';

import * as L from 'leaflet'
// HighchartsMore(Highcharts);
// HighchartsSolidGauge(Highcharts);
// window.Highcharts = Highcharts


var customIcon = L.icon({
    iconUrl: '/images/fuse-box.png',
    // shadowUrl: 'leaf-shadow.png',

    iconSize: [56, 56], // size of the icon
    shadowSize: [50, 64], // size of the shadow
    iconAnchor: [28, 28], // point of the icon which will correspond to marker's location
    shadowAnchor: [4, 62], // the same for the shadow
    // popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});

let map = L.map('map').setView([-8.744762, 115.195800], 15);
map.scrollWheelZoom.disable();
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 23,

    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
//  async function getDataDaya(){
//     const response =  await fetch('/api/monitorings')
//     const data = await response.json();

//     return  data;
//  }
// console.log(await getDataDaya());

// async function getDevice() {
//     const response = await fetch('/api/devices?nopaginate=yes')
//     const data = await response.json();

//     return data;
// }
// fetch("/api/monitorings").then(response=>response.json()).then(data=>{
//     let totalDayaR = 0;
//     let totalDayaS = 0;
//     let totalDayaT = 0;
//     let totalDaya=0;
//     data.data.forEach((element,index) => {
//     totalDayaR += element["dayar"]
//     totalDayaS += element["dayas"]
//     totalDayaT += element["dayat"]
//     });
//     totalDaya = totalDayaR + totalDayaS + totalDayaT;
//     document.getElementById("total-penggunaan-daya").textContent = totalDaya
//     document.getElementById("total-penggunaan-daya-r").textContent = totalDayaR
//     document.getElementById("total-penggunaan-daya-s").textContent = totalDayaS
//     document.getElementById("total-penggunaan-daya-t").textContent = totalDayaT
// })

let data = [
    {"vendor":"PLN Satu",
    "lokasi":"KM1100 Tol Akses Benoa",
    "status":"active",
    "lat":"-8.7283606",
    "long":"115.2113882"
},
    {"vendor":"PLN Dua",
    "lokasi":"KM1100 Tol Akses Benoa",
    "status":"active",
    "lat":"-8.7327371",
    "long":"115.211573"
},
]
    data.forEach((element, index) => {
        
       let marker =  L.marker([element['lat'], element['long']], {
            icon: customIcon
        }).addTo(map)
        var myPopup = L.popup().setContent(document.getElementById(`chanel${index}`));     

        marker.bindPopup(myPopup)
          
    });
   
   
 


// L.marker([-8.7327371,115.2126805]).addTo(map).bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
// let markertwo = L.marker([-8.7347186,115.2086846]).addTo(map)
