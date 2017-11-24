<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Mockery as m;

class BaseRepositoryTest extends TestCase
{
    /**
     * Test all
     *
     * @return void
     */
    public function testAll()
    {
        $model = m::mock('Illuminate\Database\Eloquent\Model');
        $model->shouldReceive('with')->with([])->once()->andReturn($model);
        $model->shouldReceive('get')->once()->andReturn([]);
        $repo = new DummyRepository($model);
        $this->assertEquals([], $repo->all());
    }

    /**
     * Test find
     *
     * @return void
     */
    public function testFind()
    {
        $model = m::mock('Illuminate\Database\Eloquent\Model');
        $model->shouldReceive('with')->with([])->once()->andReturn($model);
        $model->shouldReceive('find')->with(1)->once()->andReturn(true);
        $repo = new DummyRepository($model);
        $this->assertEquals(true, $repo->find(1));
    }

    /**
     * Test find or fail
     *
     * @return void
     */
    public function testFindOrFail()
    {
        $model = m::mock('Illuminate\Database\Eloquent\Model');
        $model->shouldReceive('with')->with([])->once()->andReturn($model);
        $model->shouldReceive('findOrFail')->with(1)->once()->andReturn(true);
        $repo = new DummyRepository($model);
        $this->assertEquals(true, $repo->findOrFail(1));
    }

    /**
     * Test create
     *
     * @return void
     */
    public function testCreate()
    {
        $data = [
            'foo' => 1,
            'bar' => 2,
            'baz' => 3
        ];
        $model = m::mock('Illuminate\Database\Eloquent\Model');
        $model->shouldReceive('create')->with($data)->once()->andReturn(true);
        $repo = new DummyRepository($model);
        $this->assertEquals(true, $repo->create($data));
    }

    /**
     * Test update
     *
     * @return void
     */
    public function testUpdate()
    {
        $data = [
            'foo' => 1,
            'bar' => 2,
            'baz' => 3
        ];
        $model = m::mock('Illuminate\Database\Eloquent\Model');
        $model->shouldReceive('find')->with(1)->once()->andReturn($model);
        $model->shouldReceive('update')->with($data)->once()->andReturn(true);
        $repo = new DummyRepository($model);
        $this->assertEquals(true, $repo->update(1, $data));
    }

    /**
     * Test delete
     *
     * @return void
     */
    public function testDelete()
    {
        $model = m::mock('Illuminate\Database\Eloquent\Model');
        $model->shouldReceive('destroy')->with(1)->once();
        $repo = new DummyRepository($model);
        $this->assertEquals(null, $repo->delete(1));
    }

    /**
     * Test where
     *
     * @return void
     */
    public function testWhere()
    {
        $model = m::mock('Illuminate\Database\Eloquent\Model');
        $model->shouldReceive('with')->with([])->once()->andReturn($model);
        $model->shouldReceive('where')->with(['foo' => 'bar'])->once()->andReturn($model);
        $model->shouldReceive('get')->once()->andReturn([]);
        $repo = new DummyRepository($model);
        $this->assertEquals([], $repo->where(['foo' => 'bar']));
    }

    /**
     * Test where with order
     *
     * @return void
     */
    public function testWhereWithOrder()
    {
        $model = m::mock('Illuminate\Database\Eloquent\Model');
        $model->shouldReceive('with')->with([])->once()->andReturn($model);
        $model->shouldReceive('where')->with(['foo' => 'bar'])->once()->andReturn($model);
        $model->shouldReceive('orderBy')->with('fieldName', 'desc')->once()->andReturn($model);
        $model->shouldReceive('get')->once()->andReturn([]);
        $repo = new DummyRepository($model);
        $this->assertEquals([], $repo->where(['foo' => 'bar'], 'fieldName', 'desc'));
    }

    /**
     * Test findWhere
     *
     * @return void
     */
    public function testFindWhere()
    {
        $model = m::mock('Illuminate\Database\Eloquent\Model');
        $model->shouldReceive('with')->with([])->once()->andReturn($model);
        $model->shouldReceive('where')->with(['foo' => 'bar'])->once()->andReturn($model);
        $model->shouldReceive('find')->with(1)->once()->andReturn(true);
        $repo = new DummyRepository($model);
        $this->assertEquals(true, $repo->findWhere(1, ['foo' => 'bar']));
    }

    /**
     * Test findWhereOrFail
     *
     * @return void
     */
    public function testFindWhereOrFail()
    {
        $model = m::mock('Illuminate\Database\Eloquent\Model');
        $model->shouldReceive('with')->with([])->once()->andReturn($model);
        $model->shouldReceive('where')->with(['foo' => 'bar'])->once()->andReturn($model);
        $model->shouldReceive('findOrFail')->with(1)->once()->andReturn(true);
        $repo = new DummyRepository($model);
        $this->assertEquals(true, $repo->findWhereOrFail(1, ['foo' => 'bar']));
    }

    /**
     * Test with
     *
     * @return void
     */
    public function testWith()
    {
        $model = m::mock('Illuminate\Database\Eloquent\Model');
        $model->shouldReceive('with')->with(['example'])->once()->andReturn($model);
        $model->shouldReceive('find')->with(1)->once()->andReturn(true);
        $repo = new DummyRepository($model);
        $this->assertEquals(true, $repo->with(['example'])->find(1));
    }

    /**
     * Test first or create
     *
     * @return void
     */
    public function testFirstOrCreate()
    {
        $data = [
            'foo' => 1,
            'bar' => 2,
            'baz' => 3
        ];
        $model = m::mock('Illuminate\Database\Eloquent\Model');
        $model->shouldReceive('firstOrCreate')->with($data)->once()->andReturn(true);
        $repo = new DummyRepository($model);
        $this->assertEquals(true, $repo->firstOrCreate($data));
    }

    /**
     * Test update or create
     *
     * @return void
     */
    public function testUpdateOrCreate()
    {
        $data = [
            'foo' => 1,
            'bar' => 2,
            'baz' => 3
        ];
        $model = m::mock('Illuminate\Database\Eloquent\Model');
        $model->shouldReceive('updateOrCreate')->with($data)->once()->andReturn(true);
        $repo = new DummyRepository($model);
        $this->assertEquals(true, $repo->updateOrCreate($data));
    }

    /**
     * Test get model
     *
     * @return void
     */
    public function testGetModel()
    {
        $model = m::mock('Illuminate\Database\Eloquent\Model');
        $repo = new DummyRepository($model);
        $this->assertEquals('Mockery_0_Illuminate_Database_Eloquent_Model', $repo->getModel());
    }
}
