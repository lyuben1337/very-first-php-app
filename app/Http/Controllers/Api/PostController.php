<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->postService->getAllPosts());
    }

    public function store(PostRequest $request): JsonResponse
    {
        return response()->json($this->postService->createPost($request->validated()), 201);
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->postService->getPostById($id));
    }

    public function update(PostRequest $request, $id): JsonResponse
    {
        return response()->json($this->postService->updatePost($id, $request->validated()));
    }

    public function destroy($id): JsonResponse
    {
        $this->postService->deletePost($id);

        return response()->json(['message' => 'Deleted'], 204);
    }
}
