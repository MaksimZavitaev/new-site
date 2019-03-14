<?php


namespace App\Library\Backup;


class Zip
{
    protected $config;
    protected $zip;
    protected $opened = false;
    protected $archivePath;
    protected $archiveName;

    public function __construct()
    {
        $this->config = config('backup');
        $this->zip = new \ZipArchive;

        $now = now();
        $this->archiveName = $now->format('Y-m-d_H_i') . '.zip';
        $this->archivePath = $this->config['temporaryDirectory'] .  $this->archiveName;
    }

    public function create()
    {

        $this->opened = $this->zip->open($this->archivePath, \ZipArchive::CREATE);
        foreach ($this->config['source']['databases'] as $database) {
            $filename = $database . '-dump.sql';
            $this->zip->addFile($this->config['temporaryDirectory'] . $filename, $filename);
        }

        $this->closeIfOpened();

        $content = file_get_contents($this->archivePath);

        foreach ($this->config['destination']['disks'] as $disk) {
            $storage = \Storage::disk($disk);
            $storage->put('backups/' . $this->archiveName, $content);
        }
    }

    public function closeIfOpened()
    {
        if ($this->opened) {
            $this->zip->close();
            $this->opened = false;
        }
        return $this;
    }

    public function __destruct()
    {
        $this->closeIfOpened();
        unlink($this->archivePath);
    }
}
