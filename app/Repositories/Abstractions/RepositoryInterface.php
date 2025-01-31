<?php

namespace App\Repositories\Abstractions;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @template TModel of Model
 */
interface RepositoryInterface
{
    /**
     * @return Collection<int, TModel>
     */
    public function all(): Collection;

    public function paginate(int $perPage = 10): LengthAwarePaginator;

    /**
     * @return TModel|null
     */
    public function find(int $id): ?Model;

    /**
     * @param  array<string, mixed>  $data
     * @return TModel
     */
    public function create(array $data): Model;

    /**
     * @param  array<string, mixed>  $data
     * @return TModel
     */
    public function update(int $id, array $data): Model;

    public function delete(int $id): bool;
}
