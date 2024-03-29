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
    protected $signature = 'backup:restore {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restore to latest backup';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = null;
        if ($argName = $this->argument('name')) {
            $ext = '.zip';
            $name = strpos($argName, $ext) ? $argName : $argName . $ext;

            if (!\File::isFile(storage_path("app/backups/{$name}"))) {
                $this->error('Указанный файл не найден в директории бекапов');
                return;
            }
        }

        if (app()->environment('production')) {
            $answer = $this->ask('Вы действительно хотите развернуть бекап? (yes|no)', false);
            if (!$answer || strtolower($answer) !== 'yes') {
                $this->info('Вы отменили развертывание бекапа');
                return;
            }
        }
        $this->call('down');
        $this->clear();

        $restore = app(Restore::class);
        $zip = app(Zip::class, ['archiveName' => $name]);
        $dest = $zip->unpack();
        $restore->setFrom($dest);
        foreach ($restore->run() as $data) {
            $this->info($data);
        }

        $fs = new Filesystem;
        $fs->deleteDirectory($dest);
        $this->clear();
        $this->call('up');
    }

    private function clear()
    {
        $this->call('cache:clear');
        $this->call('route:clear');
//        $this->call('route:cache');
        $this->call('config:clear');
//        $this->call('config:cache');
    }
}
