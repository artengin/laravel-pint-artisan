<?php

namespace Artengin\LaravelPintArtisan\Tests;

use Illuminate\Support\Facades\Artisan;
use RonasIT\Support\Traits\MockTrait;

class PintCommandTest extends TestCase
{
    use MockTrait;

    public function testPintCommandIsRegistered(): void
    {
        $this->assertArrayHasKey('pint', Artisan::all());
    }

    public function testPintIsNotInstalled(): void
    {
        $this->mockNativeFunction(
            'Artengin\LaravelPintArtisan\Commands',
            $this->functionCall('is_file', ['vendor/bin/pint'], false),
        );

        $this->artisan('pint')
            ->expectsOutput('Pint is not installed. Run: composer require laravel/pint --dev')
            ->assertExitCode(1);
    }
}
