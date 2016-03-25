<?php

namespace Henriale\Stinter;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\ServiceProvider as ServiceProvider;
use Henriale\Stinter\Commands\StintMakeCommand;

class StinterServiceProvider extends ServiceProvider
{
    const CONFIG_NAME = 'stinters';
    /**
     * Bootstrap the plan auditor services.
     *
     * @param \Illuminate\Contracts\Auth\Access\Gate $gate
     */
    public function boot(GateContract $gate)
    {
        $this->publishes([
            __DIR__.'/config/stinters.php' => config_path(static::CONFIG_NAME . '.php'),
        ]);

        $this->registerStintAuditors($gate);
    }

    /**
     * @todo take specific configs from stints
     *
     * @param \Illuminate\Contracts\Auth\Access\Gate $gate
     */
    private function registerStintAuditors(GateContract $gate)
    {
        $stinters = (array) config(static::CONFIG_NAME);

        foreach ($stinters as $stinter) {
            new $stinter($gate);
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
