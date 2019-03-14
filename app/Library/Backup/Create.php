<?php


namespace App\Library\Backup;

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
            exec("mysqldump --user={$config['username']} --password={$config['password']} --host={$config['host']} {$config['database']} > {$temporaryPath}{$db}.sql");
        }
    }
}
