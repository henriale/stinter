<?php

namespace Henriale\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class StintMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:stint {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new stint/auditor class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Stint';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'../stubs/stint.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Stinters';
    }

    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in base namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        return parent::buildClass($name);
    }
}
