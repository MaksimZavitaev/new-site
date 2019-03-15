<?php


namespace App\Library\Backup;

use Symfony\Component\Process\Process;

class Create
{
    protected $config;

    public function __construct()
    {
        $this->config = config('backup');
    }

    public function dumpDatabase()
    {
        $databases = $this->config['source']['databases'];
        $temporaryPath = $this->config['temporaryDirectory'];
        foreach ($databases as $db) {
            $config = config("database.connections.${db}");
            $process = new Process(sprintf(
                'mysqldump --user=%s --password=%s --host=%s -v %s > %s',
                $config['username'],
                $config['password'],
                $config['host'],
                $config['database'],
                "{$temporaryPath}{$db}.sql"
            ));
            $process->start();
            foreach ($process as $type => $data) {
                yield $data;
            }
        }
    }

    public function collectFiles()
    {
        $disks = $this->config['source']['disks'];
        $files = collect();
        foreach ($disks as $disk) {
            $storage = \Storage::disk($disk);
            $items = collect($storage->allFiles())
                ->map(function ($file) use ($storage) {
                    return str_replace(base_path(), '', $storage->path($file));
                });
            $files = $files->merge($items);
        }

        return $files;
    }
}
