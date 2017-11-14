<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Mockery as m;

class TestCase extends BaseTestCase
{
    public function tearDown()
    {
        m::close();
        parent::tearDown();
    }
}
