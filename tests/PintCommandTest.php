<?php

namespace Artengin\LaravelPintArtisan\Tests;

use Artengin\LaravelPintArtisan\ProcessRunner;
use Illuminate\Support\Facades\Artisan;
use Mockery;
use Mockery\MockInterface;
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
            namespace: 'Artengin\LaravelPintArtisan\Commands',
            callChain: $this->functionCall('is_file', ['vendor/bin/pint'], false),
        );

        $this->artisan('pint')
            ->expectsOutput('Pint is not installed. Run: composer require laravel/pint --dev')
            ->assertExitCode(1);
    }

    public function testPintRunsSuccessfully(): void
    {
        $this->mock(ProcessRunner::class, function (MockInterface $mock) {
            $mock->shouldReceive('run')
                ->once()
                ->with(
                    Mockery::on(function (array $command) {
                        $expected = ['app', '--preset=laravel'];

                        return $command === array_merge([PHP_BINARY, 'vendor/bin/pint'], $expected);
                    }),
                    Mockery::type('callable'),
                )
                ->andReturn(0);
        });

        $this->artisan('pint app --preset=laravel')
            ->assertExitCode(0);
    }
}
