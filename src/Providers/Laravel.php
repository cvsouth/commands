<?php namespace Cvsouth\Commands\Providers;

use Cvsouth\Commands\Commands\CleanLogs;

use Cvsouth\Commands\Commands\Permit;

use Cvsouth\Commands\Commands\ResetFresh;

use Cvsouth\Commands\Commands\Reset;

use Cvsouth\Commands\Commands\Deploy;

use Cvsouth\Commands\Commands\DeployVapor;

use Illuminate\Console\Scheduling\Schedule;

use Illuminate\Foundation\AliasLoader;

use Illuminate\Support\Arr;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Config;

use Illuminate\Support\Facades\DB;

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
