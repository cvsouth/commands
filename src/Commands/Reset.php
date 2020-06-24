<?php namespace Cvsouth\Commands\Commands;

use Cvsouth\Commands\Commands\Command;

use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Storage;

use Exception;

class Reset extends Command
{
    protected $signature = 'reset';

    protected $description = 'Reset application';

    public function handle() : void
    {
        $this->php_artisan('cache:clear');

        $this->php_artisan('config:cache');

        try { $this->php_artisan('route:cache'); } catch(Exception $e) { }

        if($this->package_exists('laravel/horizon'))

            $this->php_artisan('horizon:terminate');

        else $this->php_artisan('queue:restart');
    }
}
