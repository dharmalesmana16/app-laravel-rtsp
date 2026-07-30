<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVendorRequest;
use App\Http\Resources\VendorResource;
use App\Models\DataVendor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class DataVendorController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return VendorResource::collection(
            DataVendor::withCount("cameras")->latest()->paginate(50)
        );
    }

    public function store(StoreVendorRequest $request): JsonResponse
    {
        $vendor = DataVendor::create($request->validated());

        return (new VendorResource($vendor))
            ->response()
            ->setStatusCode(201);
    }

    public function show(DataVendor $vendor): VendorResource
    {
        return new VendorResource($vendor);
    }

    public function update(StoreVendorRequest $request, DataVendor $vendor): VendorResource
    {
        $vendor->update($request->validated());

        return new VendorResource($vendor);
    }

    public function destroy(DataVendor $vendor): Response
    {
        $vendor->delete();

        return response()->noContent();
    }
}
