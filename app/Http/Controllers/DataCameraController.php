<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCameraRequest;
use App\Http\Resources\CameraResource;
use App\Models\DataCamera;
use App\Services\Stream\StreamNotifier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class DataCameraController extends Controller
{
    public function __construct(private readonly StreamNotifier $stream)
    {
    }

    public function index(): AnonymousResourceCollection
    {

        return CameraResource::collection(
            DataCamera::with("vendor")->orderBy("id")->paginate(50)
        );
    }

    public function store(StoreCameraRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $camera = DataCamera::create(array_merge($validated, [
            "rtsp_port" => (int) config("camera.default_rtsp_port", 554),

            "http_port" => $validated["http_port"] ?? $this->allocateWsPort(),
        ]));

        $this->stream->cameraChanged($camera->id, StreamNotifier::ACTION_CREATED);

        return (new CameraResource($camera))
            ->response()
            ->setStatusCode(201);
    }

    protected function allocateWsPort(): int
    {
        $base = (int) config("camera.ws_port_base", 8010);

        $used = DataCamera::whereNotNull("http_port")
            ->pluck("http_port")
            ->toArray();

        $reserved = (int) config("stream.control_port", 8020);

        $port = $base;
        while (in_array($port, $used, true) || $port === $reserved) {
            $port++;
        }

        return $port;
    }

    public function show(DataCamera $camera): CameraResource
    {
        return new CameraResource($camera);
    }

    public function update(StoreCameraRequest $request, DataCamera $camera): CameraResource
    {
        $camera->update($request->validated());

        $this->stream->cameraChanged($camera->id, StreamNotifier::ACTION_UPDATED);

        return new CameraResource($camera);
    }

    public function destroy(DataCamera $camera): Response
    {
        $camera->delete();

        $this->stream->cameraChanged($camera->id, StreamNotifier::ACTION_DELETED);

        return response()->noContent();
    }
}
