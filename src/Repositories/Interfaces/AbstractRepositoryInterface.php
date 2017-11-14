<?php

namespace Matthewbdaly\LaravelRepositories\Repositories\Interfaces;

interface AbstractRepositoryInterface
{
    public function all();

    public function find($id);

    public function findOrFail($id);

    public function create(array $input);

    public function update($id, array $input);

    public function where(array $parameters, $field = null, $order = null);

    public function findWhere($id, array $parameters);

    public function with(array $tables);

    public function delete($id);
}
