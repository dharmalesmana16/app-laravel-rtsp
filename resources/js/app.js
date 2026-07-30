import './bootstrap';
import Alpine from 'alpinejs';
import $ from 'jquery';
import Swal from 'sweetalert2';

window.$ = $;
window.Swal = Swal;
window.Alpine = Alpine;

window.streamWsUrl = function (port) {
    const proto = window.location.protocol === 'https:' ? 'wss' : 'ws';
    const isStdPort =
    window.location.port === '' ||
        window.location.port === '80' ||
        window.location.port === '443';

        if (isStdPort) {
            return `${proto}://${window.location.host}/ws/${port}`;
        }
    return `${proto}://${window.location.hostname}:${port}`;
};

Alpine.start();
