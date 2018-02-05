<?php

namespace Tests\Unit\Console;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Artisan;

class RepositoryMakeTest extends TestCase
{
    /**
     * Test creating a repository
     *
     * @return void
     */
    public function testCreatingARepository()
    {
        Artisan::call('make:repository', [
            'name' => 'Foo'
        ]);
    }
}
