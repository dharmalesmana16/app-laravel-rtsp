<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Node Stream Service Control
    |--------------------------------------------------------------------------
    |
    | Endpoint HTTP pada Node stream service (resources/js/stream.js) untuk
    | memicu resync instan saat terjadi CRUD kamera, tanpa menunggu polling
    | interval. Polling berkala tetap berjalan sebagai fail-safe.
    |
    */

    'control_url' => env('STREAM_CONTROL_URL', 'http://127.0.0.1:8020'),

    'control_token' => env('STREAM_CONTROL_TOKEN', env('STREAM_SERVICE_TOKEN', '')),

    // Port HTTP kontrol stream service. Wajib dicadangkan (dilewati) oleh
    // alokasi http_port kamera agar tidak bentrok dengan WS server kamera.
    'control_port' => (int) env('STREAM_CONTROL_PORT', 8020),

];
