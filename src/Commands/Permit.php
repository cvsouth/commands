<?php namespace Cvsouth\Commands\Commands;

class Permit extends Command
{
    protected $signature = 'permit';

    public function handle()
    {
        if(env('USER', false))
        {
            echo $this->terminal('sudo chown -R ' . env('USER') . ':' . env('GROUP', 'www-data') . ' .');
        
            echo $this->terminal('sudo chown -R ' . env('USER') . ':' . env('GROUP', 'www-data') . ' ~/.npm');
        }
        echo $this->terminal('sudo find . -type d -exec chmod 755 {} \;');
        
        echo $this->terminal('sudo find . -type d -exec chmod ug+s {} \;');
        
        echo $this->terminal('sudo find . -type f -exec chmod 644 {} \;');
        
        echo $this->terminal('sudo chgrp -R www-data storage bootstrap/cache');
        
        echo $this->terminal('sudo chmod -R ug+rwx storage bootstrap/cache');
        
        echo $this->terminal('sudo chmod -R u+x node_modules');
    }
}
