<?php

namespace Matthewbdaly\LaravelRepositories\Repositories\Decorators;

use Matthewbdaly\LaravelRepositories\Repositories\Interfaces\AbstractRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Base decorator class
 */
abstract class BaseDecorator implements AbstractRepositoryInterface
{
    /**
     * The repository to be used by the decorator
     *
     * @var object
     */
    protected $repository;

    /**
     * The cache implementation
     *
     * @var object
     */
    protected $cache;

    /**
     * Get all rows
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->cache->tags($this->getModel())->remember('all', 60, function () {
            return $this->repository->all();
        });
    }

    /**
     * Get single row
     *
     * @param integer $id The object ID.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find(int $id)
    {
        return $this->cache->tags($this->getModel())->remember($id, 60, function () use ($id) {
            return $this->repository->find($id);
        });
    }

    /**
     * Get single row, or throw a 404
     *
     * @param integer $id The object ID.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrFail(int $id)
    {
        return $this->cache->tags($this->getModel())->remember($id, 60, function () use ($id) {
            return $this->repository->findOrFail($id);
        });
    }

    /**
     * Create row
     *
     * @param array $input The input data.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $input)
    {
        $this->cache->tags($this->getModel())->flush();
        return $this->repository->create($input);
    }

    /**
     * Update row
     *
     * @param integer $id    The object ID.
     * @param array   $input The input data.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $input)
    {
        $this->cache->tags($this->getModel())->flush();
        return $this->repository->update($id, $input);
    }

    /**
     * Delete row
     *
     * @param integer $id The object ID.
     * @return null
     */
    public function delete(int $id)
    {
        $this->cache->tags($this->getModel())->flush();
        return $this->repository->delete($id);
    }

    /**
     * Get rows matching parameters
     *
     * @param array  $parameters The parameters.
     * @param string $field      The field.
     * @param string $order      The order.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function where(array $parameters, string $field = null, string $order = null)
    {
        $key = "";
        foreach ($parameters as $k => $v) {
            $key .= $k . "_" . $v . "_";
        }
        if ($field) {
            $key .= $field;
        }
        if ($order) {
            $key .= $order;
        }
        return $this->cache->tags($this->getModel())->remember($key, 60, function () use ($parameters, $field, $order) {
            return $this->repository->where($parameters, $field, $order);
        });
    }

    /**
     * Get a single row matching parameters
     *
     * @param integer $id         The object ID.
     * @param array   $parameters The parameters.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findWhere(int $id, array $parameters)
    {
        $key = $id . "_";
        foreach ($parameters as $k => $v) {
            $key .= $k . "_" . $v . "_";
        }
        return $this->cache->tags($this->getModel())->remember($key, 60, function () use ($id, $parameters) {
            return $this->repository->findWhere($id, $parameters);
        });
    }

    /**
     * Get a single row matching parameters, or throw a 404
     *
     * @param integer $id         The object ID.
     * @param array   $parameters The parameters.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findWhereOrFail(int $id, array $parameters)
    {
        $key = $id . "_";
        foreach ($parameters as $k => $v) {
            $key .= $k . "_" . $v . "_";
        }
        return $this->cache->tags($this->getModel())->remember($key, 60, function () use ($id, $parameters) {
            return $this->repository->findWhereOrFail($id, $parameters);
        });
    }

    /**
     * Set includes
     *
     * @param array $tables The tables to include.
     * @return \Matthewbdaly\LaravelRepositories\Repositories\Base
     */
    public function with(array $tables)
    {
        return $this->repository->with($tables);
    }

    /**
     * Get model name
     *
     * @return string
     */
    public function getModel()
    {
        return $this->repository->getModel();
    }

    /**
     * Get or create row
     *
     * @param array $input The input data.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstOrCreate(array $input)
    {
        $this->cache->tags($this->getModel())->flush();
        return $this->repository->firstOrCreate($input);
    }

    /**
     * Update or create row
     *
     * @param array $input The input data.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $input)
    {
        $this->cache->tags($this->getModel())->flush();
        return $this->repository->updateOrCreate($input);
    }

    /**
     * Attach a model
     *
     * @param mixed $model The first model.
     * @param string $relation The relationship on the first model.
     * @param \Illuminate\Database\Eloquent\Model $value The model to attach.
     *
     * @return void
     */
    public function attach($model, string $relation, Model $value)
    {
        $this->cache->tags($this->getModel())->flush();
        return $this->repository->attach($model, $relation, $value);
    }

    /**
     * Detach a model
     *
     * @param mixed $model The first model.
     * @param string $relation The relationship on the first model.
     * @param \Illuminate\Database\Eloquent\Model $value The model to attach.
     *
     * @return void
     */
    public function detach($model, string $relation, Model $value)
    {
        $this->cache->tags($this->getModel())->flush();
        return $this->repository->detach($model, $relation, $value);
    }
}
