<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCameraRequest;
use App\Http\Resources\CameraResource;
use App\Models\DataCamera;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class DataCameraController extends Controller
{
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

        return (new CameraResource($camera))
            ->response()
            ->setStatusCode(201);
    }

    protected function allocateWsPort(): int
    {
        $base = (int) config("camera.ws_port_base", 8010);

        $used = DataCamera::withTrashed()
            ->whereNotNull("http_port")
            ->pluck("http_port")
            ->toArray();

        $port = $base;
        while (in_array($port, $used, true)) {
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

        return new CameraResource($camera);
    }

    public function destroy(DataCamera $camera): Response
    {
        $camera->delete();

        return response()->noContent();
    }
}
