<?php

namespace Matthewbdaly\LaravelRepositories\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Builds decorators
 */
class DecoratorMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository:decorator {name : The required name of the decorator class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a repository decorator';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Decorator';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/decorator.stub';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the decorator.'],
        ];
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace The root namespace for the class.
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Eloquent\Repositories\Decorators';
    }
}
