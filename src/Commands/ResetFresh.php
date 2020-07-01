<?php namespace Cvsouth\Commands\Commands;

use Cvsouth\Commands\Commands\Command;

use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Storage;

class ResetFresh extends Command
{
    protected $signature = 'reset:fresh';

    protected $description = 'Reset application from scratch';

    public function handle() : void
    {
        $this->php_artisan('cache:clear');

        $this->php_artisan('clean-logs');

        $this->php_artisan('key:generate');

        $this->php_artisan('config:clear');

        $this->php_artisan('event:cache');

        $this->php_artisan('migrate:fresh', ['--force' => 'default', '--no-interaction' => 'default']);

        $this->php_artisan('route:clear');

        if($this->package_exists('laravel/passport'))

            $this->php_artisan('passport:install', ['--force' => 'default']);

        if($this->package_exists('laravel/horizon'))

            $this->php_artisan('horizon:terminate');

        else $this->php_artisan('queue:restart');

        if(!App::environment('local'))

            $this->php_artisan('schedule:run');
    }
}
