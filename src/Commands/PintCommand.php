<?php

namespace Artengin\LaravelPintArtisan\Commands;

use Illuminate\Console\Command;
use RuntimeException;
use Symfony\Component\Process\Exception\ProcessSignaledException;
use Symfony\Component\Process\Process;

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
    public function __construct()
    {
        parent::__construct();

        $this->ignoreValidationErrors();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $argv = $_SERVER['argv'];

        $options = array_slice($argv, 2);

        $binary = 'vendor/bin/pint';

        if (!is_file($binary)) {
            $this->error('Pint is not installed. Run: composer require laravel/pint --dev');

            return self::FAILURE;
        }

        $process = new Process(array_merge([PHP_BINARY, $binary], $options));

        $process->setTimeout(null);

        try {
            $process->setTty(true);
        } catch (RuntimeException $e) {
            // TTY is not available
        }

        $exitCode = self::FAILURE;

        try {
            $exitCode = $process->run(function ($type, $line) {
                $this->output->write($line);
            });
        } catch (ProcessSignaledException $e) {
            if (extension_loaded('pcntl') && $e->getSignal() !== SIGINT) {
                throw $e;
            }
        }

        return $exitCode;
    }
}
