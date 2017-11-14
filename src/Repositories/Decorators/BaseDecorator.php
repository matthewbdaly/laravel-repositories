<?php

namespace Matthewbdaly\LaravelRepositories\Repositories\Decorators;

use Matthewbdaly\LaravelRepositories\Repositories\Interfaces\AbstractRepositoryInterface;

abstract class BaseDecorator implements AbstractRepositoryInterface
{
    protected $repository;

    protected $cache;

    protected $model;

    public function all()
    {
        return $this->cache->tags($this->getModel())->remember('all', 60, function () {
            return $this->repository->all();
        });
    }

    public function find($id)
    {
        return $this->cache->tags($this->getModel())->remember($id, 60, function () use ($id) {
            return $this->repository->find($id);
        });
    }

    public function findOrFail($id)
    {
        return $this->cache->tags($this->getModel())->remember($id, 60, function () use ($id) {
            return $this->repository->findOrFail($id);
        });
    }

    public function create(array $input)
    {
        $this->cache->tags($this->getModel())->flush();
        return $this->repository->create($input);
    }

    public function update($id, array $input)
    {
        $this->cache->tags($this->getModel())->flush();
        return $this->repository->update($id, $input);
    }

    public function delete($id)
    {
        $this->cache->tags($this->getModel())->flush();
        return $this->repository->delete($id);
    }

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

    public function with(array $tables)
    {
        return $this->repository->with($tables);
    }

    protected function getModel()
    {
        return $this->model;
    }
}
