<?php

namespace App\Repositories\Abstractions;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 *
 * @implements RepositoryInterface<TModel>
 */
abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * @var TModel
     */
    protected Model $model;

    /**
     * @param  TModel  $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection<int, TModel>
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @return TModel|null
     */
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return TModel
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return TModel
     *
     * @throws Exception
     */
    public function update(int $id, array $data): Model
    {
        $model = $this->find($id);

        if (! $model) {
            throw new Exception('Model not found.');
        }

        $model->update($data);

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);

        return $model && $model->delete();
    }
}
