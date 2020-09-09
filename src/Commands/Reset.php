<?php namespace Cvsouth\Commands\Commands;

use Cvsouth\Commands\Commands\Command;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;

class Reset extends Command
{
    protected $signature = 'reset';

    protected $description = 'Reset application';

    public function handle() : void
    {
        $this->php_artisan('cache:clear');

        if(app()->environment('local'))

            $this->php_artisan('config:clear');

        else $this->php_artisan('config:cache');

        if(app()->environment('local'))

            $this->php_artisan('route:clear');

        else $this->php_artisan('route:cache');

        if(app()->environment('local'))

            $this->php_artisan('event:clear');

        else $this->php_artisan('event:cache');

        if(env('PERMIT_DURING_RESET', false) && app()->environment('local', 'testing'))

            $this->php_artisan('permit');
        
        File::delete(public_path('storage'));

        $this->php_artisan('storage:link');

        if($this->package_exists('laravel/horizon'))

            $this->php_artisan('horizon:terminate');

        else $this->php_artisan('queue:restart');
    }
}
