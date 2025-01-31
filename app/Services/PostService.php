<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PostService
{
    protected PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPosts(): Collection
    {
        return $this->postRepository->all();
    }

    public function getAllPostsPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return $this->postRepository->paginate($perPage);
    }

    public function getPostById($id): ?Post
    {
        return $this->postRepository->find($id);
    }

    public function createPost(array $data): Post
    {
        return $this->postRepository->create($data);
    }

    public function updatePost($id, array $data): Post
    {
        return $this->postRepository->update($id, $data);
    }

    public function deletePost($id): bool
    {
        return $this->postRepository->delete($id);
    }
}
