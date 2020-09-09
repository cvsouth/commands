<?php namespace Cvsouth\Commands\Commands;

use Cvsouth\Commands\Commands\Command;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;

class ResetVapor extends Command
{
    protected $signature = 'reset-vapor';

    protected $description = 'Reset application for Vapor';

    public function handle() : void
    {
        $this->php_artisan('cache:clear');

        $this->php_artisan('config:cache');

        $this->php_artisan('route:cache');

        $this->php_artisan('event:cache');

        File::delete(public_path('storage'));

        if($this->package_exists('laravel/horizon'))

            $this->php_artisan('horizon:terminate');

        else $this->php_artisan('queue:restart');
    }
}
