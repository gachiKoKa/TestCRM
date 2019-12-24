<?php

namespace App\Repositories;

use Exception;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    /** @var Model */
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Container $container
     * @throws BindingResolutionException
     */
    public function __construct(Container $container)
    {
        $model = $this->model();
        $this->model = $container->make($model);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return int
     */
    public function update(int $id, array $data): int
    {
        $model = $this->find($id);

        if (is_null($model)) {
            return 0;
        }

        return $model->update($data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $entity = $this->find($id);

        if (is_null($entity)) {
            return false;
        }

        try {
            $deleted = (bool)$entity->delete();
        } catch (Exception $exception) {
            $deleted = false;
        }

        return $deleted;
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * @return Builder
     */
    public function getBuilder(): Builder
    {
        return $this->model->newModelQuery();
    }

    /**
     * @return Model[]
     */
    public function all(): iterable
    {
        return $this->model->all();
    }

    /**
     * @return string
     */
    abstract public function model(): string;
}
