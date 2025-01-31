<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostIndexRequest;
use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PostController extends Controller
{
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(PostIndexRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $perPage = $validated['per_page'] ?? 10;

        $posts = $this->postService->getAllPostsPaginated($perPage);

        return response()->json($posts);
    }

    public function store(PostRequest $request): JsonResponse
    {
        return response()->json($this->postService->createPost($request->validated()), Response::HTTP_CREATED);
    }

    public function show($id): JsonResponse
    {
        $post = $this->postService->getPostById($id);

        return response()->json($post);
    }

    public function update(PostRequest $request, $id): JsonResponse
    {
        $this->postService->updatePost($id, $request->validated());

        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    public function destroy($id): JsonResponse
    {
        $this->postService->deletePost($id);

        return response()->json(['message' => 'Deleted'], Response::HTTP_NO_CONTENT);
    }
}
