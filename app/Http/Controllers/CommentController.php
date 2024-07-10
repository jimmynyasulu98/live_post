<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page_size = $request->page_size ?? 15;
        $comments = Comment::query()->paginate($page_size);
        return CommentResource::collection($comments);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $createdRecord = Comment::query()->create(
            [
                'user_id' => $request->user_id,
                'post_id' => $request->post_id,
                'body' => $request->body,
            ]
        );
        return new CommentResource($createdRecord);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $updatedRecord = $comment->update(
            [
                'body' => $request->body ?? $comment->body,
            ]
        );
        if(!$updatedRecord){
            return new JsonResponse([
                'Errors' => ['could not update record'],
            ],400);
        }

        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $deletedRecord = $comment->forceDelete();
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
