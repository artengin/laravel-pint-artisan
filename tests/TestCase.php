<?php

namespace Artengin\LaravelPintArtisan\Tests;

use Artengin\LaravelPintArtisan\PintArtisanServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            PintArtisanServiceProvider::class,
        ];
    }
}
