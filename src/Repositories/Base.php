<?php

namespace Matthewbdaly\LaravelRepositories\Repositories;

use Matthewbdaly\LaravelRepositories\Repositories\Interfaces\AbstractRepositoryInterface;

abstract class Base implements AbstractRepositoryInterface
{
    /**
     * The model to be used by the repository
     *
     * @var object
     */
    protected $model;

    /**
     * The includes for the current query
     *
     * @var array
     */
    protected $with = [];

    /**
     * Get all rows
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        $response = $this->model->with($this->with)->get();
        $this->with = [];
        return $response;
    }

    /**
     * Get single row
     *
     * @param integer $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id)
    {
        $response = $this->model->with($this->with)->find($id);
        $this->with = [];
        return $response;
    }

    /**
     * Get single row, or throw a 404
     *
     * @param integer $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrFail($id)
    {
        $response = $this->model->with($this->with)->findOrFail($id);
        $this->with = [];
        return $response;
    }

    /**
     * Create row
     *
     * @param array $input
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $input)
    {
        return $this->model->create($input);
    }

    /**
     * Update row
     *
     * @param integer $id
     * @param array $input
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($id, array $input)
    {
        return $this->model->find($id)->update($input);
    }

    /**
     * Delete row
     *
     * @param integer $id
     * @return null
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Get rows matching parameters
     *
     * @param array $parameters
     * @param string $field
     * @param string $order
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function where(array $parameters, $field = null, $order = null)
    {
        $query = $this->model->with($this->with)->where($parameters);
        if ($order) {
            $query->orderBy($field, $order);
        }
        $response = $query->get();
        $this->with = [];
        return $response;
    }

    /**
     * Get a single row matching parameters
     *
     * @param integer $id
     * @param array $parameters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findWhere($id, array $parameters)
    {
        $response = $this->model->with($this->with)->where($parameters)->find($id);
        $this->with = [];
        return $response;
    }

    /**
     * Get a single row matching parameters, or throw a 404
     *
     * @param integer $id
     * @param array $parameters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findWhereOrFail($id, array $parameters)
    {
        $response = $this->model->with($this->with)->where($parameters)->findOrFail($id);
        $this->with = [];
        return $response;
    }

    /**
     * Set includes
     *
     * @param array $input
     * @return \Matthewbdaly\LaravelRepositories\Repositories\Base
     */
    public function with(array $tables)
    {
        $this->with = $tables;
        return $this;
    }
}
