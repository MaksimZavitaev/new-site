<?php


namespace App\Library\Backup;


use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Process\Process;

class Restore
{
    protected $config;
    protected $from;

    public function __construct()
    {
        $this->config = config('backup');
    }

    public function setFrom($path)
    {
        $this->from = $path;
        return $this;
    }

    public function run()
    {
        $fs = new Filesystem();
        $files = collect($fs->files($this->from));
        foreach ($this->config['source']['databases'] as $db) {
            $file = $this->from . $db . '.sql';
            if ($fs->exists($file)) {
                $config = config("database.connections.${db}");
                $process = new Process(sprintf(
                    'mysql --user=%s --password=%s --host=%s -v %s < %s',
                    $config['username'],
                    $config['password'],
                    $config['host'],
                    $config['database'],
                    $file
                ));
                $process->start();
                foreach ($process as $type => $data) {
                    yield $data;
                }
            }
        }
    }
}
