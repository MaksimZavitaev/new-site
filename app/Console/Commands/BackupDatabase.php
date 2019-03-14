<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make backup of database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $databases = config('backup.source.databases');
        $temporaryPath = config('backup.temporaryDirectory');
        $now = Carbon::now();
        foreach ($databases as $db) {
            $config = config("database.connections.${db}");
            exec("mysqldump --user={$config['username']} --password={$config['password']} --host={$config['host']} {$config['database']} > {$temporaryPath}{$now->format('Y-m-d_H_i')}.sql");
        }
    }
}
