import 'leaflet/dist/leaflet.css';
import * as L from 'leaflet';

function initMap() {
    const mapEl = document.getElementById('map');
    if (!mapEl) {
        return;
    }

    const cameras = (window.cameraLocations || []).filter(
        (c) => c.latitude !== null && c.longitude !== null
    );

    const customIcon = L.icon({
        iconUrl: '/images/fuse-box.png',
        iconSize: [56, 56],
        iconAnchor: [28, 28],
        popupAnchor: [0, -28],
    });

    const defaultCenter = [-8.662882, 115.217619];
    const map = L.map('map').setView(defaultCenter, 14);
    map.scrollWheelZoom.disable();

    const stadiaKey = import.meta.env.VITE_STADIA_API_KEY;
    if (stadiaKey) {
        L.tileLayer(`https://tiles.stadiamaps.com/tiles/alidade_smooth/{z}/{x}/{y}{r}.png?api_key=${stadiaKey}`, {
            maxZoom: 21,
            attribution: '&copy; <a href="https://stadiamaps.com/" target="_blank">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a>',
        }).addTo(map);
    } else {
        console.warn('VITE_STADIA_API_KEY belum diset di .env');
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a>',
        }).addTo(map);
    }

    if (cameras.length === 0) {
        return;
    }

    const markers = cameras.map((camera) => {
        const lat = parseFloat(camera.latitude);
        const long = parseFloat(camera.longitude);
        const isOnline = Boolean(camera.last_on);
        const vendorName = camera.vendor?.nama_perusahaan ?? '-';

        const statusBadge = isOnline
            ? '<span style="color:#16a34a;font-weight:600">● Online</span>'
            : '<span style="color:#dc2626;font-weight:600">● Offline</span>';

        const popupHtml = `
            <div style="min-width:180px">
                <div style="font-weight:700;font-size:14px;margin-bottom:4px">${camera.ip}</div>
                <div style="font-size:12px;color:#6b7280">Brand: ${camera.brand ?? '-'}</div>
                <div style="font-size:12px;color:#6b7280">Vendor: ${vendorName}</div>
                <div style="font-size:12px;margin-top:6px">${statusBadge}</div>
            </div>`;

        return L.marker([lat, long], { icon: customIcon })
            .addTo(map)
            .bindPopup(popupHtml);
    });

    if (markers.length > 1) {
        const group = L.featureGroup(markers);
        map.fitBounds(group.getBounds(), { padding: [50, 50] });
    } else {
        map.setView([parseFloat(cameras[0].latitude), parseFloat(cameras[0].longitude)], 15);
    }
}

initMap();
