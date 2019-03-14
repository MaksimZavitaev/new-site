<?php

namespace App\Console\Commands;

use App\Library\Backup\Restore;
use App\Library\Backup\Zip;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class BackupRestoreCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:restore';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restore to latest backup';

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
        if (app()->environment('production')) {
            $answer = $this->ask('Вы действительно хотите развернуть бекап? (yes|no)', false);
            if (!$answer || strtolower($answer) !== 'yes') {
                $this->info('Вы отменили развертывание бекапа');
                return;
            }
        }

        $restore = app(Restore::class);
        $zip = app(Zip::class);
        $dest = $zip->unpack();
        $restore
            ->setFrom($dest)
            ->run();
        $fs = new Filesystem;
        $fs->deleteDirectory($dest);
    }
}
