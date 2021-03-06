<?php namespace Cvsouth\Commands\Commands;

use Cvsouth\Commands\Commands\Command;

use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;

class ResetFresh extends Command
{
    protected $signature = 'reset:fresh';

    protected $description = 'Reset application from scratch';

    public function handle() : void
    {
        $this->php_artisan('cache:clear');

        $this->php_artisan('clean-logs');

        $this->terminal('touch storage/logs/laravel.log');

        $this->php_artisan('key:generate');

        if(true || app()->environment('local')) // TODO: Change when

            $this->php_artisan('config:clear');

        else $this->php_artisan('config:cache');

        if(true || app()->environment('local')) // TODO: Change when

            $this->php_artisan('route:clear');

        else $this->php_artisan('route:cache');

        $this->php_artisan('migrate:fresh', ['--force' => 'default', '--no-interaction' => 'default']);

        if(app()->environment('local'))

            $this->php_artisan('event:clear');

        else $this->php_artisan('event:cache');

        if(env('PERMIT_DURING_RESET', false) && app()->environment('local', 'testing'))

            echo $this->php_artisan('permit');

        File::delete(public_path('storage'));

        $this->php_artisan('storage:link');

        if($this->package_exists('laravel/passport'))

            $this->php_artisan('passport:install', ['--force' => 'default']);

        if($this->package_exists('laravel/horizon'))

            $this->php_artisan('horizon:terminate');

        else $this->php_artisan('queue:restart');

        $this->php_artisan('schedule:run');
    }
}
