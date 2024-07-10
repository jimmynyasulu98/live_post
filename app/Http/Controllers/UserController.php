<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return ResourceCollection;
     */
    public function index(Request $request)
    {
        $page_size = $request->page_size ?? 15;
        $users = User::query()->paginate($page_size);
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return UserResource
     */
    public function store(Request $request)
    {
        $createdRecord = User::query()->create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]
        );
        
        return new UserResource($createdRecord);
    }

    /**
     * Display the specified resource.
     * @param  User $user
     * @return UserResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     * @param  User $user
     * @param Request $request
     * @return UserResource | JsonResponse
     */
    public function update(Request $request, User $user)
    {
        $updatedRecord = $user->update(
            [
                'name' => $request->name ?? $user->name,
                'email'  => $request->email ?? $user->email,
            ]
        );
        if(!$updatedRecord){
            return new JsonResponse([
                'Errors' => ['could not update record'],
            ],400);
        }

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     * @param  User $user
     * @return JsonResponse
     */
    public function destroy(User $user)
    {
        $deletedRecord = $user->forceDelete();
        if(!$deletedRecord){
            return new JsonResponse([
                'Errors' => ['could not delete record'],
            ],400);
        }

        return new JsonResponse([
            'data' => 'success',
        ]);
    }
}
