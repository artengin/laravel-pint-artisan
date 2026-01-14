<?php

namespace Artengin\LaravelPintArtisan;

use Closure;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Process\Exception\ProcessSignaledException;
use Symfony\Component\Process\Process;

class ProcessRunner
{
    protected Closure $createProcess;

    public function __construct(?callable $createProcess = null)
    {
        $this->createProcess = $createProcess !== null
            ? $createProcess(...)
            : static fn (array $cmd) => new Process($cmd);
    }

    public function run(array $command, callable $outputWriter): int
    {
        $process = ($this->createProcess)($command);

        $process->setTimeout(null);

        try {
            $process->setTty(true);
        } catch (RuntimeException $e) {
            // TTY is not available
        }

        $exitCode = Command::FAILURE;

        try {
            $exitCode = $process->run($outputWriter);
        } catch (ProcessSignaledException $e) {
            if (extension_loaded('pcntl') && $e->getSignal() !== SIGINT) {
                throw $e;
            }
        }

        return $exitCode;
    }
}
