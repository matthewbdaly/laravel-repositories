<?php

namespace Matthewbdaly\LaravelRepositories\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Builds repositories
 */
class RepositoryMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name : The required name of the repository class} {--all : Include contract and decorator}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a repository with decorator and interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/repository.stub';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the repository.'],
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
        return $rootNamespace.'\Eloquent\Repositories';
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {
        parent::handle();
        if ($this->option('all')) {
            $this->call('make:repository:contract', [
                'name' => $this->argument('name')
            ]);
            $this->call('make:repository:decorator', [
                'name' => $this->argument('name')
            ]);
        }
    }
}
