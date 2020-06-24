<?php namespace Cvsouth\Commands\Commands;

use Illuminate\Console\Command as BaseCommand;

use Symfony\Component\Process\Process;

abstract class Command extends BaseCommand
{
    protected function terminal($command)
    {
        if(is_array($command)) $command = implode(' ', $command);
        
        return shell_exec($command);
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
