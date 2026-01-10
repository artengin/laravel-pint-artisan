<?php

namespace Artengin\LaravelPintArtisan;

use Artengin\LaravelPintArtisan\Commands\PintCommand;
use Illuminate\Support\ServiceProvider;

class PintArtisanServiceProvider extends ServiceProvider
{
    /**
     * Boots application services.
     */
    public function boot(): void
    {
        $this->commands([
            PintCommand::class,
        ]);
    }
}
