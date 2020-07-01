<?php namespace Cvsouth\Commands\Commands;

use Cvsouth\Commands\Commands\Command;

use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Storage;

class DeployVapor extends Command
{
    protected $signature = 'deploy-vapor';

    protected $description = 'Deploy application with Vapor';

    public function handle() : void
    {
        $this->php_artisan('migrate', ['--force' => 'default', '--no-interaction' => 'default']);
    }
}
