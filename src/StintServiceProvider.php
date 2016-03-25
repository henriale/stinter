<?php

namespace Henriale\Stinter;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\ServiceProvider as ServiceProvider;
use Henriale\Console\Commands\StintMakeCommand;

class StintServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the plan constraints services.
     *
     * @param \Illuminate\Contracts\Auth\Access\Gate $gate
     */
    public function boot(GateContract $gate)
    {
        $this->publishes([
            __DIR__.'/config/stinters.php' => config_path('stinters.php'),
        ]);

        $this->registerStintAuditors($gate);
    }

    /**
     * @param \Illuminate\Contracts\Auth\Access\Gate $gate
     */
    private function registerStintAuditors(GateContract $gate)
    {
        foreach (config('stinters') as $stint) {
            new $stint($gate);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerStintGenerator();
    }

    /**
     * Register the make:stint generator.
     */
    private function registerStintGenerator()
    {
        $this->app->singleton('command.henriale.stinter', function ($app) {
            return $app[StintMakeCommand::class];
        });

        $this->commands('command.henriale.stinter');
    }
}
