<?php

return [

    'default_rtsp_port' => (int) env('CAMERA_DEFAULT_RTSP_PORT', 554),

    'default_brand' => env('CAMERA_DEFAULT_BRAND', 'EZVIZ'),

    'ws_port_base' => (int) env('CAMERA_WS_PORT_BASE', 8010),

    'builders' => [
        'EZVIZ' => \App\Services\Rtsp\DahuaUrlBuilder::class,
        'DAHUA' => \App\Services\Rtsp\DahuaUrlBuilder::class,
        'HIKVISION' => \App\Services\Rtsp\HikvisionUrlBuilder::class,
    ],
];
