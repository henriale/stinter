<?php

namespace Henriale\Stinter\Provider;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\ServiceProvider as ServiceProvider;

class StintServiceProvider extends ServiceProvider
{
    /**
     * The restrictions mapping to control plan's resources.
     *
     * @var array
     */
    protected $stints = [
        //
    ];

    /**
     * Bootstrap the plan constraints services.
     *
     * @param \Illuminate\Contracts\Auth\Access\Gate $gate
     */
    public function boot(GateContract $gate)
    {
        foreach ($this->stints as $stint) {
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
        //
    }
}
