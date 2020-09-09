<?php namespace Cvsouth\Commands\Commands;

use Cvsouth\Commands\Commands\Command;

use Illuminate\Support\Facades\Storage;

class Deploy extends Command
{
    protected $signature = 'deploy';

    protected $description = 'Deploy application';

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

        $this->php_artisan('migrate', ['--force' => 'default', '--no-interaction' => 'default']);

        if($this->package_exists('laravel/horizon'))

            $this->php_artisan('horizon:terminate');

        else $this->php_artisan('queue:restart');
    }
}
