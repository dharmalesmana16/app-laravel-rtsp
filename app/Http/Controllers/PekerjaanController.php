<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePekerjaanRequest;
use App\Http\Resources\PekerjaanResource;
use App\Models\Pekerjaan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PekerjaanController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return PekerjaanResource::collection(
            Pekerjaan::with('vendor:id,nama_perusahaan')->latest()->paginate(50)
        );
    }

    public function store(StorePekerjaanRequest $request): JsonResponse
    {
        $pekerjaan = Pekerjaan::create($request->validated());

        $pekerjaan->load('vendor:id,nama_perusahaan');

        return (new PekerjaanResource($pekerjaan))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Pekerjaan $pekerjaan): PekerjaanResource
    {
        $pekerjaan->load('vendor:id,nama_perusahaan');

        return new PekerjaanResource($pekerjaan);
    }

    public function update(StorePekerjaanRequest $request, Pekerjaan $pekerjaan): PekerjaanResource
    {
        $pekerjaan->update($request->validated());

        $pekerjaan->load('vendor:id,nama_perusahaan');

        return new PekerjaanResource($pekerjaan);
    }

    public function destroy(Pekerjaan $pekerjaan): Response
    {
        $pekerjaan->delete();

        return response()->noContent();
    }
}
