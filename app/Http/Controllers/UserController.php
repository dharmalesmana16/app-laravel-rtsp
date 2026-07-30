<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(
            User::latest()->paginate(50)
        );
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return (new UserResource($user))
            ->response()
            ->setStatusCode(201);
    }

    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    public function update(StoreUserRequest $request, User $user): UserResource
    {
        $data = $request->validated();

        if ($data['password'] ?? null) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return new UserResource($user);
    }

    public function destroy(User $user): Response
    {
        if ($user->id === request()->user()->id) {
            abort(403, 'Tidak bisa menghapus diri sendiri');
        }

        $user->delete();

        return response()->noContent();
    }
}
