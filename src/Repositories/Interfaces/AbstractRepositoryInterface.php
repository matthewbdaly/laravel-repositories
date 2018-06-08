<?php

namespace Matthewbdaly\LaravelRepositories\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface AbstractRepositoryInterface
{
    /**
     * Get all rows
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Get single row
     *
     * @param integer $id The object ID.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find(int $id);

    /**
     * Get single row, or throw a 404
     *
     * @param integer $id The object ID.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrFail(int $id);

    /**
     * Create row
     *
     * @param array $input The input data.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $input);

    /**
     * Update row
     *
     * @param integer $id    The object ID.
     * @param array   $input The input data.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $input);

    /**
     * Delete row
     *
     * @param integer $id The object ID.
     * @return null
     */
    public function delete(int $id);

    /**
     * Get rows matching parameters
     *
     * @param array  $parameters The parameters.
     * @param string $field      The field.
     * @param string $order      The order.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function where(array $parameters, string $field = null, string $order = null);

    /**
     * Get a single row matching parameters
     *
     * @param integer $id         The object ID.
     * @param array   $parameters The parameters.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findWhere(int $id, array $parameters);

    /**
     * Get a single row matching parameters, or throw a 404
     *
     * @param integer $id         The object ID.
     * @param array   $parameters The parameters.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findWhereOrFail(int $id, array $parameters);

    /**
     * Set includes
     *
     * @param array $tables The tables to include.
     * @return \Matthewbdaly\LaravelRepositories\Repositories\Base
     */
    public function with(array $tables);

    /**
     * Get model name
     *
     * @return string
     */
    public function getModel();

    /**
     * Get or create row
     *
     * @param array $input The input data.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstOrCreate(array $input);

    /**
     * Update or create row
     *
     * @param array $input The input data.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $input);

    /**
     * Attach a model
     *
     * @param mixed $model The first model.
     * @param string $relation The relationship on the first model.
     * @param \Illuminate\Database\Eloquent\Model $value The model to attach.
     *
     * @return void
     */
    public function attach($model, string $relation, Model $value);

    /**
     * Detach a model
     *
     * @param mixed $model The first model.
     * @param string $relation The relationship on the first model.
     * @param \Illuminate\Database\Eloquent\Model $value The model to attach.
     *
     * @return void
     */
    public function detach($model, string $relation, Model $value);
}
