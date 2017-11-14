<?php

namespace Tests\Unit\Repositories\Decorators;

use Matthewbdaly\LaravelRepositories\Repositories\Decorators\BaseDecorator;
use Matthewbdaly\LaravelRepositories\Repositories\Interfaces\AbstractRepositoryInterface;
use Illuminate\Contracts\Cache\Repository as Cache;

class DummyDecorator extends BaseDecorator implements AbstractRepositoryInterface
{
    protected $model = 'Dummy';

    public function __construct(AbstractRepositoryInterface $repository, Cache $cache)
    {
        $this->repository = $repository;
        $this->cache = $cache;
    }
}
