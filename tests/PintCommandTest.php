<?php

namespace Artengin\LaravelPintArtisan\Tests;

use Artengin\LaravelPintArtisan\ProcessRunner;
use Illuminate\Support\Facades\Artisan;

class PintCommandTest extends TestCase
{
    public function testPintCommandIsRegistered(): void
    {
        $this->assertArrayHasKey('pint', Artisan::all());
    }

    public function testPintIsNotInstalled(): void
    {
        $this->mockNativeFunction(
            namespace: 'Artengin\LaravelPintArtisan\Commands',
            callChain: $this->functionCall('is_file', ['vendor/bin/pint'], false),
        );

        $this->artisan('pint')
            ->expectsOutput('Pint is not installed. Run: composer require laravel/pint --dev')
            ->assertExitCode(1);
    }

    public function testPintRunsSuccessfully(): void
    {
        $this->mockNativeFunction(
            namespace: 'Artengin\LaravelPintArtisan\Commands',
            callChain: $this->functionCall('is_file', ['vendor/bin/pint']),
        );

        $this->mockClass(ProcessRunner::class, [
            $this->functionCall('run', [
                [PHP_BINARY, 'vendor/bin/pint', 'app', '--preset=laravel'],
                self::ANY_ARGUMENT,
            ], 0),
        ]);

        $this->artisan('pint app --preset=laravel')
            ->assertExitCode(0);
    }
}
