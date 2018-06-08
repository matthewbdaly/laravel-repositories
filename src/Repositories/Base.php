<?php

namespace Matthewbdaly\LaravelRepositories\Repositories;

use Matthewbdaly\LaravelRepositories\Repositories\Interfaces\AbstractRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Base repository
 */
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
     * @param integer $id The object ID.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find(int $id)
    {
        $response = $this->model->with($this->with)->find($id);
        $this->with = [];
        return $response;
    }

    /**
     * Get single row, or throw a 404
     *
     * @param integer $id The object ID.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrFail(int $id)
    {
        $response = $this->model->with($this->with)->findOrFail($id);
        $this->with = [];
        return $response;
    }

    /**
     * Create row
     *
     * @param array $input The input data.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $input)
    {
        return $this->model->create($input);
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
        return $this->model->find($id)->update($input);
    }

    /**
     * Delete row
     *
     * @param integer $id The object ID.
     * @return null
     */
    public function delete(int $id)
    {
        return $this->model->destroy($id);
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
     * @param integer $id         The object ID.
     * @param array   $parameters The parameters.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findWhere(int $id, array $parameters)
    {
        $response = $this->model->with($this->with)->where($parameters)->find($id);
        $this->with = [];
        return $response;
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
        $response = $this->model->with($this->with)->where($parameters)->findOrFail($id);
        $this->with = [];
        return $response;
    }

    /**
     * Set includes
     *
     * @param array $tables The tables to include.
     * @return \Matthewbdaly\LaravelRepositories\Repositories\Base
     */
    public function with(array $tables)
    {
        $this->with = $tables;
        return $this;
    }

    /**
     * Get model name
     *
     * @return string
     */
    public function getModel()
    {
        return get_class($this->model);
    }

    /**
     * Get or create row
     *
     * @param array $input The input data.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstOrCreate(array $input)
    {
        return $this->model->firstOrCreate($input);
    }

    /**
     * Update or create row
     *
     * @param array $input The input data.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $input)
    {
        return $this->model->updateOrCreate($input);
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
        if (! $model instanceof Model) {
            $model = $this->find($model);
        }

        $model->$relation()->attach($value);
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
        if (! $model instanceof Model) {
            $model = $this->find($model);
        }

        $model->$relation()->detach($value);
    }
}
