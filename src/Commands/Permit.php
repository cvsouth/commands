<?php namespace Cvsouth\Commands\Commands;

use Illuminate\Console\Command;

use Cvsouth\Foundation\Facades\Server;

class Permit extends Command
{
    protected $signature = 'permit';

    public function handle()
    {
        if(env('USER', false))
        {
            echo Server::terminal('sudo chown -R ' . env('USER') . ':' . env('GROUP', 'www-data') . ' .');
        
            echo Server::terminal('sudo chown -R ' . env('USER') . ':' . env('GROUP', 'www-data') . ' ~/.npm');
        }
        echo Server::terminal('sudo find . -type d -exec chmod 755 {} \;');
        
        echo Server::terminal('sudo find . -type d -exec chmod ug+s {} \;');
        
        echo Server::terminal('sudo find . -type f -exec chmod 644 {} \;');
        
        echo Server::terminal('sudo chgrp -R www-data storage bootstrap/cache');
        
        echo Server::terminal('sudo chmod -R ug+rwx storage bootstrap/cache');
        
        echo Server::terminal('sudo chmod -R u+x node_modules');
    }
}
