<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Abstractions\AbstractRepository;

/**
 * @extends AbstractRepository<Post>
 */
class PostRepository extends AbstractRepository
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }
}
