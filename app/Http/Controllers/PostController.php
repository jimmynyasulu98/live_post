<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return ResourceCollection
     */
    public function index(Request $request)
    {
        $page_size = $request->page_size ?? 15;
        $posts = Post::query()->paginate($page_size);
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $createdRecord = DB::transaction( function () use($request){
            $createdRecord = Post::query()->create(
                [
                    'title' => $request->title,
                    'body' => $request->body,
                ]
            );
            $createdRecord->users()->sync($request->user_ids);
            return $createdRecord;

        });

        return new PostResource($createdRecord);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $updatedRecord = $post->update(
            [
                'title' => $request->title ?? $post->title,
                'body'  => $request->body ?? $post->body,
            ]
        );
        if(!$updatedRecord){
            return new JsonResponse([
                'Errors' => ['could not update record'],
            ],400);
        }

        return new PostResource($updatedRecord);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $deletedRecord = $post->forceDelete();
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
