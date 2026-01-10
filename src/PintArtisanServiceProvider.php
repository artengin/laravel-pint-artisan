<?php

namespace Artengin\LaravelPintArtisan;

use Illuminate\Support\ServiceProvider;

class PintArtisanServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->commands([
            PintCommand::class,
        ]);
    }

    public function boot(): void
    {
        //
    }
}
