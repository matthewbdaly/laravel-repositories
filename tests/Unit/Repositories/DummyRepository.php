<?php

namespace Tests\Unit\Repositories;

use Matthewbdaly\LaravelRepositories\Repositories\Base;
use Matthewbdaly\LaravelRepositories\Repositories\Interfaces\AbstractRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class DummyRepository extends Base implements AbstractRepositoryInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
