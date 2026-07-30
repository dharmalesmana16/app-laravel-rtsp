<?php

namespace App\Services\Rtsp\Contracts;

use App\Models\DataCamera;

interface BuildsRtspUrl
{

    public function build(DataCamera $camera): string;
}
