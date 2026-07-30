<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKartuRequest;
use App\Http\Resources\KartuResource;
use App\Models\DataKartu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class KartuController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return KartuResource::collection(
            DataKartu::withCount('camera')->latest()->paginate(50)
        );
    }

    public function store(StoreKartuRequest $request): JsonResponse
    {
        $kartu = DataKartu::create($request->validated());

        return (new KartuResource($kartu))
            ->response()
            ->setStatusCode(201);
    }

    public function show(DataKartu $kartu): KartuResource
    {
        return new KartuResource($kartu);
    }

    public function update(StoreKartuRequest $request, DataKartu $kartu): KartuResource
    {
        $kartu->update($request->validated());

        return new KartuResource($kartu);
    }

    public function destroy(DataKartu $kartu): Response
    {
        $kartu->delete();

        return response()->noContent();
    }
}
