<?php

namespace Matthewbdaly\LaravelRepositories\Providers;

use Illuminate\Support\ServiceProvider;
use Matthewbdaly\LaravelRepositories\Console\Commands\ContractMakeCommand;
use Matthewbdaly\LaravelRepositories\Console\Commands\DecoratorMakeCommand;
use Matthewbdaly\LaravelRepositories\Console\Commands\RepositoryMakeCommand;

class LaravelRepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ContractMakeCommand::class,
                DecoratorMakeCommand::class,
                RepositoryMakeCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
