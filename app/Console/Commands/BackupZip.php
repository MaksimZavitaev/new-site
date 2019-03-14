<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class BackupZip extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:zip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Zipping temporary directory';

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
        $temporaryDirectory = config('backup.temporaryDirectory');
        $now = now();
        $archiveName = $now->format('Y-m-d_H_i') . '.zip';
        $archivePath = $temporaryDirectory . $archiveName;
        $zip = new \ZipArchive;
        $opened = $zip->open($archivePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        if ($opened) {
            $this->info('Creating zip archive on temporary directory');
            $databases = config('backup.source.databases');
            foreach ($databases as $database) {
                $filename = $database . '-dump.sql';
                $zip->addFile($temporaryDirectory . $filename, $filename);
            }
            $zip->close();

            $this->info('Move archive to destinations');
            $destination = config('backup.destination');
            foreach ($destination['disks'] as $disk) {
                $storage = \Storage::disk($disk);
                $content = file_get_contents($archivePath);
                $storage->put('backups/' . $archiveName, $content);
            }
            unlink($archivePath);
        }
    }
}
