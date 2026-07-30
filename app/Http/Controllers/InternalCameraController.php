<?php

namespace App\Http\Controllers;

use App\Models\DataCamera;
use App\Services\Rtsp\RtspUrlBuilderFactory;
use Illuminate\Http\JsonResponse;

class InternalCameraController extends Controller
{
    public function __construct(private readonly RtspUrlBuilderFactory $factory)
    {
    }

    public function index(): JsonResponse
    {
        $cameras = DataCamera::select(['id', 'http_port'])
            ->orderBy('id')
            ->get()
            ->map(fn (DataCamera $c) => [
                'id' => $c->id,
                'http_port' => $c->http_port,
            ]);

        return response()->json(['data' => $cameras]);
    }

    public function rtspUrl(DataCamera $camera): JsonResponse
    {
        $url = $this->factory->for($camera)->build($camera);

        return response()->json(['url' => $url])
            ->header('Cache-Control', 'no-store');
    }

    public function heartbeat(DataCamera $camera): JsonResponse
    {
        $camera->update(['last_on' => now()]);

        return response()->json(['ok' => true, 'last_on' => $camera->last_on]);
    }
}
