<?php


namespace App\Library\Backup;


use Illuminate\Filesystem\Filesystem;

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
            $file = $this->from . $db . '-dump.sql';
            if ($fs->exists($file)) {
                $config = config("database.connections.${db}");
                exec("mysql --user={$config['username']} --password={$config['password']} --host={$config['host']} {$config['database']} < $file");
            }
        }
    }
}
