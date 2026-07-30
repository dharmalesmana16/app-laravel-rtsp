<?php

namespace App\Services\Rtsp;

use App\Models\DataCamera;
use App\Services\Rtsp\Contracts\BuildsRtspUrl;

class HikvisionUrlBuilder extends DahuaUrlBuilder implements BuildsRtspUrl
{
    public function build(DataCamera $camera): string
    {
        $credentials = $this->credentialsSegment($camera);
        $port = $camera->rtsp_port ?: (int) config('camera.default_rtsp_port', 554);

        return sprintf(
            'rtsp://%s%s:%d/Streaming/Channels/%s01',
            $credentials,
            $camera->ip,
            $port,
            $camera->channel ?: 1
        );
    }
}
