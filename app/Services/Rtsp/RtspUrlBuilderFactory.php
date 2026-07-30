<?php

namespace App\Services\Rtsp;

use App\Models\DataCamera;
use App\Services\Rtsp\Contracts\BuildsRtspUrl;
use InvalidArgumentException;

class RtspUrlBuilderFactory
{
    public function for(DataCamera $camera): BuildsRtspUrl
    {
        $builders = (array) config('camera.builders', []);
        $defaultBrand = (string) config('camera.default_brand', 'EZVIZ');

        $brand = strtoupper(trim((string) $camera->brand)) ?: $defaultBrand;

        $class = $builders[$brand]
            ?? $builders[$defaultBrand]
            ?? DahuaUrlBuilder::class;

        if (!is_subclass_of($class, BuildsRtspUrl::class)) {
            throw new InvalidArgumentException("RTSP builder [{$class}] tidak mengimplementasikan BuildsRtspUrl.");
        }

        return app($class);
    }
}
