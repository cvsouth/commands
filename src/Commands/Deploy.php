<?php namespace Cvsouth\Commands\Commands;

use Cvsouth\Commands\Commands\Command;

use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Storage;

class Deploy extends Command
{
    protected $signature = 'deploy';

    protected $description = 'Deploy application';

    public function handle() : void
    {
        $this->php_artisan('cache:clear');

        $this->php_artisan('config:cache');

        $this->php_artisan('route:cache');

        if(env('PERMIT_DURING_RESET', false) && App::environment('local', 'testing'))

            $this->php_artisan('permit');

        $this->php_artisan('migrate', ['--force' => 'default', '--no-interaction' => 'default']);

        if($this->package_exists('laravel/horizon'))

            $this->php_artisan('horizon:terminate');

        else $this->php_artisan('queue:restart');
    }
}
