<?php namespace Cvsouth\Commands\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Storage;

class Reset extends Command
{
    protected $signature = 'reset';
   
    protected $description = 'Reset application';

    public function handle() : void
    {
        $this->php_artisan('cache:clear');

        $this->php_artisan('config:cache');

        $this->php_artisan('route:clear');

        if(env('PERMIT_DURING_RESET', false) && App::environment('local', 'testing'))

            $this->php_artisan('permit');

        if(package_exists('laravel/horizon'))

            $this->php_artisan('horizon:terminate');

        else $this->php_artisan('queue:restart');
    }
    private function php_artisan($command, $params = [])
    {
        return $this->call($command, $params);
    }
}
