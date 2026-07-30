import 'leaflet/dist/leaflet.css';
import * as L from 'leaflet';

function initMap() {
    const mapEl = document.getElementById('map');
    if (!mapEl) {
        return;
    }

    const customIcon = L.icon({
        iconUrl: '/images/fuse-box.png',
        iconSize: [56, 56],
        iconAnchor: [28, 28],
    });

    const map = L.map('map').setView([-8.662882, 115.217619], 14);
    map.scrollWheelZoom.disable();

    const stadiaKey = import.meta.env.VITE_STADIA_API_KEY;
    if (!stadiaKey) {
        console.warn('VITE_STADIA_API_KEY belum diset di .env — tile map tidak akan tampil');
    }
    L.tileLayer(`https://tiles.stadiamaps.com/tiles/alidade_smooth/{z}/{x}/{y}{r}.png?api_key=${stadiaKey}`, {
        maxZoom: 21,
        attribution: '&copy; <a href="https://stadiamaps.com/" target="_blank">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a>',
    }).addTo(map);

    const data = [
        { vendor: 'PLN Satu', lokasi: 'KM1100 Tol Akses Benoa', status: 'active', lat: '-8.662882', long: '115.217619' },
        { vendor: 'PLN Dua', lokasi: 'KM1100 Tol Akses Benoa', status: 'active', lat: '-8.7327371', long: '115.211573' },
    ];

    data.forEach((element, index) => {
        const popupSource = document.getElementById(`chanel${index}`);
        if (!popupSource) {
            return;
        }
        const marker = L.marker([element.lat, element.long], { icon: customIcon }).addTo(map);
        marker.bindPopup(L.popup().setContent(popupSource));
    });
}

initMap();
