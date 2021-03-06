<?php

namespace SystemInc\LaravelAdmin\Console;

use File;
use Illuminate\Console\Command;
use SystemInc\LaravelAdmin\Traits\HelpersTrait;

class DumpCommand extends Command
{
    use HelpersTrait;

    protected $name = 'laravel-admin:dump-database';
    protected $description = 'Dump DB file to .sql';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-admin:dump-database';

    public function handle()
    {
        if (empty(config('laravel-admin'))) {
            $this->error('First install Laravel Admin with laravel-admin:install');

            return false;
        }

        $this->consoleSignature();

        $this->line('Dumpping...');
        $this->line('');
        $migration = 'sla_' . gmdate('Y_m_d_His') . '.sql';

        $path = app_path('../database/sla_dumps');

        if (!File::exists($path)) {
            File::makeDirectory($path, 493, true);
        }

        $dumpMigration = $path . '/' . $migration;

        $this->info('Output path will be: ' . $dumpMigration);

        exec('mysqldump -u ' . env('DB_USERNAME') . ' -p' . env('DB_PASSWORD') . ' ' . env('DB_DATABASE') . ' -r ' . $dumpMigration . ' 2>/dev/null', $output, $return_var);

        $this->line('');

        if ($return_var != 0) {
            File::delete($dumpMigration);

            $this->error('Dumpping error!');
        } else {
            $this->info('Dumpping Done!');
        }

        $this->line('');
    }
}
