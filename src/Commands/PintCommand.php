<?php

namespace Artengin\LaravelPintArtisan\Commands;

use Artengin\LaravelPintArtisan\ProcessRunner;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\ArgvInput;

class PintCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pint';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Pint from Artisan, fully supporting all arguments, flags, and paths';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(protected ProcessRunner $processRunner)
    {
        parent::__construct();

        $this->ignoreValidationErrors();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        /** @var ArgvInput $argvInput */
        $argvInput = $this->input;
        $options = $argvInput->getRawTokens(true);

        $binary = 'vendor/bin/pint';

        if (!is_file($binary)) {
            $this->error('Pint is not installed. Run: composer require laravel/pint --dev');

            return self::FAILURE;
        }

        return $this->processRunner->run(
            array_merge([PHP_BINARY, $binary], $options),
            fn ($type, $line) => $this->output->write($line),
        );
    }
}
