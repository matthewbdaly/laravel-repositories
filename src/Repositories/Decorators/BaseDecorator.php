<?php

namespace Matthewbdaly\LaravelRepositories\Repositories\Decorators;

use Matthewbdaly\LaravelRepositories\Repositories\Interfaces\AbstractRepositoryInterface;

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
     * The model to be used by the repository
     *
     * @var object
     */
    protected $model;

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
     * @param array  $parameters
     * @param string $field
     * @param string $order
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function where(array $parameters, $field = null, $order = null)
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
     * @param integer $id
     * @param array   $parameters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findWhere($id, array $parameters)
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
     * @param integer $id
     * @param array   $parameters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findWhereOrFail($id, array $parameters)
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
     * @param array $input
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
    protected function getModel()
    {
        return $this->model;
    }
}
