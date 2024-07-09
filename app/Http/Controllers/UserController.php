<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse;
     */
    public function index()
    {
        return new JsonResponse([
            'data' => 'Json Data'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        return new JsonResponse([
            'data' => 'posted',
            'data1' => $request
        ]);
    }

    /**
     * Display the specified resource.
     * @param  User $user
     * @return JsonResponse
     */
    public function show(User $user)
    {
        return new JsonResponse([
            'data' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  User $user
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request, User $user)
    {
        return new JsonResponse([
            'data' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return new JsonResponse([
            'data' => $user
        ]);
    }
}
