# laravel-repositories

[![Build Status](https://travis-ci.org/matthewbdaly/laravel-repositories.svg?branch=master)](https://travis-ci.org/matthewbdaly/laravel-repositories)
[![Coverage Status](https://coveralls.io/repos/github/matthewbdaly/laravel-repositories/badge.svg?branch=master)](https://coveralls.io/github/matthewbdaly/laravel-repositories?branch=master)
A base repository class and interface, together with a caching decorator. Extend them for use in your own projects.

The base interface is `Matthewbdaly\LaravelRepositories\Repositories\Interfaces\AbstractRepositoryInterface`. Your repositories should have interfaces that extend this, to facilitate type-hinting them.

This interface is implemented by both the abstract decorator `Matthewbdaly\LaravelRepositories\Repositories\Decorators\BaseDecorator` and the abstract repository `Matthewbdaly\LaravelRepositories\Repositories\Base`. Again, you should extend these classes to create your own repositories and decorators. You can then resolve these interfaces in your own service provider as follows:

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Repositories\Interfaces\ExampleRepositoryInterface', function () {
            $baseRepo = new \App\Repositories\EloquentExampleRepository(new \App\Example);
            $cachingRepo = new \App\Repositories\Decorators\ExampleDecorator($baseRepo, $this->app['cache.store']);
            return $cachingRepo;
        });
    }
}
```

Artisan tasks
-------------

This package implements the following Artisan tasks to help writing boilerplate:

* `make:repository` - Makes a repository for the model passed, ie `php artisan make:repository Foo`. Pass the `--all` flag to also create the contract and decorator.
* `make:repository:contract` - Makes a contract for the model passed, ie `php artisan make:repository:contract Foo`
* `make:repository:decorator` - Makes a decorator for the model passed, ie `php artisan make:repository:decorator Foo`
