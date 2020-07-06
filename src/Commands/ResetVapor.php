<?php namespace Cvsouth\Commands\Commands;

use Cvsouth\Commands\Commands\Command;

use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;

class ResetVapor extends Command
{
    protected $signature = 'reset-vapor';

    protected $description = 'Reset application for Vapor';

    public function handle() : void
    {
        $this->php_artisan('cache:clear');

        $this->php_artisan('config:clear');

        $this->php_artisan('route:clear');

        $this->php_artisan('event:cache');

        if(env('PERMIT_DURING_RESET', false) && App::environment('local', 'testing'))

            $this->php_artisan('permit');
        
        File::delete(public_path('storage'));

        if($this->package_exists('laravel/horizon'))

            $this->php_artisan('horizon:terminate');

        else $this->php_artisan('queue:restart');
    }
}
