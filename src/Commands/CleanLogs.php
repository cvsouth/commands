<?php namespace Cvsouth\Commands\Commands;

class CleanLogs extends Command
{
    protected $signature = 'clean-logs {--lines=0}';

    protected $description = 'Clean logs';

    public function handle()
    {
        $lines = $this->option('lines');

        foreach(glob(storage_path('logs/') . '*.{log}', GLOB_BRACE) as $log_file)

            echo $this->terminal('echo "`tail -' . $lines . ' ' . $log_file . '`" > ' . $log_file);
    }
}
