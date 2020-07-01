<?php namespace Cvsouth\Commands\Providers;

use Cvsouth\Commands\Commands\CleanLogs;

use Cvsouth\Commands\Commands\Permit;

use Cvsouth\Commands\Commands\ResetFresh;

use Cvsouth\Commands\Commands\Reset;

use Cvsouth\Commands\Commands\Deploy;

use Cvsouth\Commands\Commands\DeployVapor;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class Laravel extends BaseServiceProvider
{
    public function boot()
    {
        if($this->app->runningInConsole())

            $this->commands
            ([
                CleanLogs::class,

                Permit::class,

                Deploy::class,

                DeployVapor::class,

                Reset::class,

                ResetFresh::class,
            ]);
    }
    public function register()
    {

    }
}
