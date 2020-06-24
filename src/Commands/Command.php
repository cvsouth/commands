<?php namespace Cvsouth\Commands\Commands;

use Illuminate\Console\Command as BaseCommand;

use Symfony\Component\Process\Process;

abstract class Command extends BaseCommand
{
    protected function terminal($command)
    {
        $process = new Process($command);

        $process->run();

        return $process->getOutput();
    }
    protected function package_exists($package)
    {
        return is_dir(base_path() . '/vendor/' . $package);
    }
    protected function php_artisan($command, $params = [])
    {
        return $this->call($command, $params);
    }
}
