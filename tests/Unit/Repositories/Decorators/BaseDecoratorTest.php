<?php

namespace Tests\Unit\Repositories\Decorators;

use Tests\TestCase;
use Mockery as m;

class BaseDecoratorTest extends TestCase
{
    /**
     * Test all
     *
     * @return void
     */
    public function testAll()
    {
        $repo = m::mock('Matthewbdaly\LaravelRepositories\Repositories\Interfaces\AbstractRepositoryInterface');
        $repo->shouldReceive('getModel')->once()->andReturn('Dummy');
        $cache = m::mock('Illuminate\Contracts\Cache\Repository');
        $decorator = new DummyDecorator($repo, $cache);
        $cache->shouldReceive('tags')->with('Dummy')->once()->andReturn($cache);
        $cache->shouldReceive('remember')->once()->andReturn([]);
        $this->assertEquals([], $decorator->all());
    }

    /**
     * Test find
     *
     * @return void
     */
    public function testFind()
    {
        $repo = m::mock('Matthewbdaly\LaravelRepositories\Repositories\Interfaces\AbstractRepositoryInterface');
        $repo->shouldReceive('getModel')->once()->andReturn('Dummy');
        $cache = m::mock('Illuminate\Contracts\Cache\Repository');
        $decorator = new DummyDecorator($repo, $cache);
        $cache->shouldReceive('tags')->with('Dummy')->once()->andReturn($cache);
        $cache->shouldReceive('remember')->once()->andReturn([]);
        $this->assertEquals([], $decorator->find(1));
    }

    /**
     * Test find or fail
     *
     * @return void
     */
    public function testFindOrFail()
    {
        $repo = m::mock('Matthewbdaly\LaravelRepositories\Repositories\Interfaces\AbstractRepositoryInterface');
        $repo->shouldReceive('getModel')->once()->andReturn('Dummy');
        $cache = m::mock('Illuminate\Contracts\Cache\Repository');
        $decorator = new DummyDecorator($repo, $cache);
        $cache->shouldReceive('tags')->with('Dummy')->once()->andReturn($cache);
        $cache->shouldReceive('remember')->once()->andReturn([]);
        $this->assertEquals([], $decorator->findOrFail(1));
    }

    /**
     * Test create
     *
     * @return void
     */
    public function testCreate()
    {
        $repo = m::mock('Matthewbdaly\LaravelRepositories\Repositories\Interfaces\AbstractRepositoryInterface');
        $repo->shouldReceive('getModel')->once()->andReturn('Dummy');
        $cache = m::mock('Illuminate\Contracts\Cache\Repository');
        $decorator = new DummyDecorator($repo, $cache);
        $repo->shouldReceive('create')->with([])->once()->andReturn([]);
        $cache->shouldReceive('tags')->once()->andReturn($cache);
        $cache->shouldReceive('flush')->once();
        $this->assertEquals([], $decorator->create([]));
    }

    /**
     * Test update
     *
     * @return void
     */
    public function testUpdate()
    {
        $repo = m::mock('Matthewbdaly\LaravelRepositories\Repositories\Interfaces\AbstractRepositoryInterface');
        $repo->shouldReceive('getModel')->once()->andReturn('Dummy');
        $cache = m::mock('Illuminate\Contracts\Cache\Repository');
        $decorator = new DummyDecorator($repo, $cache);
        $repo->shouldReceive('update')->with(1, [])->once()->andReturn([]);
        $cache->shouldReceive('tags')->once()->andReturn($cache);
        $cache->shouldReceive('flush')->once();
        $this->assertEquals([], $decorator->update(1, []));
    }

    /**
     * Test delete
     *
     * @return void
     */
    public function testDelete()
    {
        $repo = m::mock('Matthewbdaly\LaravelRepositories\Repositories\Interfaces\AbstractRepositoryInterface');
        $repo->shouldReceive('getModel')->once()->andReturn('Dummy');
        $cache = m::mock('Illuminate\Contracts\Cache\Repository');
        $decorator = new DummyDecorator($repo, $cache);
        $repo->shouldReceive('delete')->with(1)->once()->andReturn(true);
        $cache->shouldReceive('tags')->once()->andReturn($cache);
        $cache->shouldReceive('flush')->once();
        $this->assertEquals(true, $decorator->delete(1));
    }

    /**
     * Test where
     *
     * @return void
     */
    public function testWhere()
    {
        $repo = m::mock('Matthewbdaly\LaravelRepositories\Repositories\Interfaces\AbstractRepositoryInterface');
        $repo->shouldReceive('getModel')->once()->andReturn('Dummy');
        $cache = m::mock('Illuminate\Contracts\Cache\Repository');
        $decorator = new DummyDecorator($repo, $cache);
        $cache->shouldReceive('tags')->once()->andReturn($cache);
        $cache->shouldReceive('remember')->once()->andReturn([]);
        $this->assertEquals([], $decorator->where(['foo' => 'bar']));
    }

    /**
     * Test where with order
     *
     * @return void
     */
    public function testWhereWithOrder()
    {
        $repo = m::mock('Matthewbdaly\LaravelRepositories\Repositories\Interfaces\AbstractRepositoryInterface');
        $repo->shouldReceive('getModel')->once()->andReturn('Dummy');
        $cache = m::mock('Illuminate\Contracts\Cache\Repository');
        $decorator = new DummyDecorator($repo, $cache);
        $cache->shouldReceive('tags')->once()->andReturn($cache);
        $cache->shouldReceive('remember')->once()->andReturn([]);
        $this->assertEquals([], $decorator->where(['foo' => 'bar'], 'fieldName', 'desc'));
    }

    /**
     * Test findWhere
     *
     * @return void
     */
    public function testFindWhere()
    {
        $repo = m::mock('Matthewbdaly\LaravelRepositories\Repositories\Interfaces\AbstractRepositoryInterface');
        $repo->shouldReceive('getModel')->once()->andReturn('Dummy');
        $cache = m::mock('Illuminate\Contracts\Cache\Repository');
        $decorator = new DummyDecorator($repo, $cache);
        $cache->shouldReceive('tags')->once()->andReturn($cache);
        $cache->shouldReceive('remember')->once()->andReturn(true);
        $this->assertEquals(true, $decorator->findWhere(1, ['foo' => 'bar']));
    }

    /**
     * Test findWhereOrFail
     *
     * @return void
     */
    public function testFindWhereOrFail()
    {
        $repo = m::mock('Matthewbdaly\LaravelRepositories\Repositories\Interfaces\AbstractRepositoryInterface');
        $repo->shouldReceive('getModel')->once()->andReturn('Dummy');
        $cache = m::mock('Illuminate\Contracts\Cache\Repository');
        $decorator = new DummyDecorator($repo, $cache);
        $cache->shouldReceive('tags')->once()->andReturn($cache);
        $cache->shouldReceive('remember')->once()->andReturn(true);
        $this->assertEquals(true, $decorator->findWhereOrFail(1, ['foo' => 'bar']));
    }

    /**
     * Test with
     *
     * @return void
     */
    public function testWith()
    {
        $repo = m::mock('Matthewbdaly\LaravelRepositories\Repositories\Interfaces\AbstractRepositoryInterface');
        $cache = m::mock('Illuminate\Contracts\Cache\Repository');
        $decorator = new DummyDecorator($repo, $cache);
        $repo->shouldReceive('with')->with(['example'])->once()->andReturn($repo);
        $repo->shouldReceive('find')->with(1)->once()->andReturn(true);
        $this->assertEquals(true, $repo->with(['example'])->find(1));
    }

    /**
     * Test first or create
     *
     * @return void
     */
    public function testFirstOrCreate()
    {
        $repo = m::mock('Matthewbdaly\LaravelRepositories\Repositories\Interfaces\AbstractRepositoryInterface');
        $repo->shouldReceive('getModel')->once()->andReturn('Dummy');
        $cache = m::mock('Illuminate\Contracts\Cache\Repository');
        $decorator = new DummyDecorator($repo, $cache);
        $repo->shouldReceive('firstOrCreate')->with([])->once()->andReturn([]);
        $cache->shouldReceive('tags')->once()->andReturn($cache);
        $cache->shouldReceive('flush')->once();
        $this->assertEquals([], $decorator->firstOrCreate([]));
    }

    /**
     * Test update or create
     *
     * @return void
     */
    public function testUpdateOrCreate()
    {
        $repo = m::mock('Matthewbdaly\LaravelRepositories\Repositories\Interfaces\AbstractRepositoryInterface');
        $repo->shouldReceive('getModel')->once()->andReturn('Dummy');
        $cache = m::mock('Illuminate\Contracts\Cache\Repository');
        $decorator = new DummyDecorator($repo, $cache);
        $repo->shouldReceive('updateOrCreate')->with([])->once()->andReturn([]);
        $cache->shouldReceive('tags')->once()->andReturn($cache);
        $cache->shouldReceive('flush')->once();
        $this->assertEquals([], $decorator->updateOrCreate([]));
    }
}
