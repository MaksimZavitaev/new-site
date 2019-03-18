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
        $this->from = realpath($path);
        return $this;
    }

    public function run()
    {
        $fs = new Filesystem();
        $files = collect($fs->allFiles($this->from));
        foreach ($files as $file) {
            /** @var SplFileInfo $file */
            if ($file->getExtension() === 'sql') {
                $db = $file->getBasename('.sql');
                if ($config = config("database.connections.{$db}")) {
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
                $fs->delete($file);
                continue;
            }

//            copy($file->getRealPath(), base_path($file->getRelativePathname()));
            $path = base_path($file->getRelativePath());
            $dest = $file->getRelativePathname();
            if ($fs->exists($dest)) {
                $fs->delete($dest);
            }
            if (!$fs->exists($path)) {
                $fs->makeDirectory($path);
            }
            $fs->copy($file->getRealPath(), base_path($dest));
            yield "Copying file {$dest}";
            $fs->delete($file);
        }
    }
}
