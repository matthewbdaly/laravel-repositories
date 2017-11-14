# laravel-repositories

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
