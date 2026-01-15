<?php

namespace Artengin\LaravelPintArtisan\Tests;

use Artengin\LaravelPintArtisan\PintArtisanServiceProvider;
use Artengin\LaravelPintArtisan\Tests\Support\MockTrait;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use MockTrait;

    protected function getPackageProviders($app): array
    {
        return [
            PintArtisanServiceProvider::class,
        ];
    }
}
