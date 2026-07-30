<?php

namespace App\Services\Rtsp;

use App\Models\DataCamera;
use App\Services\Rtsp\Contracts\BuildsRtspUrl;

class DahuaUrlBuilder implements BuildsRtspUrl
{
    public function build(DataCamera $camera): string
    {
        $credentials = $this->credentialsSegment($camera);
        $port = $camera->rtsp_port ?: (int) config('camera.default_rtsp_port', 554);

        return sprintf(
            'rtsp://%s%s:%d/cam/realmonitor?channel=%s&subtype=1',
            $credentials,
            $camera->ip,
            $port,
            $camera->channel ?: 1
        );
    }

    protected function credentialsSegment(DataCamera $camera): string
    {
        if (!filled($camera->auth_user) || !filled($camera->auth_password)) {
            return '';
        }

        return sprintf('%s:%s@', urlencode($camera->auth_user), urlencode($camera->auth_password));
    }
}
