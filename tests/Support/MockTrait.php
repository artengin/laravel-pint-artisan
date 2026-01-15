<?php

namespace Artengin\LaravelPintArtisan\Tests\Support;

use RonasIT\Support\Traits\MockTrait as RonasITMockTrait;

trait MockTrait
{
    use RonasITMockTrait;

    protected const ANY_ARGUMENT = 'anyArgument';

    protected function compareArguments(array $actual, array $expected, string $message): void
    {
        foreach ($actual as $index => $argument) {
            if (isset($expected[$index]) && $expected[$index] === self::ANY_ARGUMENT) {
                continue;
            }

            $this->assertEquals(
                $expected[$index],
                $argument,
                "Failed asserting that arguments are equal to expected.\n{$message}\nArgument index: {$index}",
            );
        }
    }
}
