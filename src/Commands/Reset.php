<?php namespace Cvsouth\Commands\Commands;

use Cvsouth\Commands\Commands\Command;

use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;

class Reset extends Command
{
    protected $signature = 'reset';

    protected $description = 'Reset application';

    public function handle() : void
    {
        $this->php_artisan('cache:clear');

        $this->php_artisan('config:clear');

        $this->php_artisan('route:cache');

        $this->php_artisan('event:cache');

        if(env('PERMIT_DURING_RESET', false) && App::environment('local', 'testing'))

            $this->php_artisan('permit');
        
        File::delete(public_path('storage'));

        $this->php_artisan('storage:link');

        if($this->package_exists('laravel/horizon'))

            $this->php_artisan('horizon:terminate');

        else $this->php_artisan('queue:restart');
    }
}
