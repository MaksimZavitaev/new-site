<?php


namespace App\Library\Backup;


use Illuminate\Filesystem\Filesystem;
use ZipArchive;

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
        $this->archivePath = $this->config['temporaryDirectory'] . $this->archiveName;
    }

    public function open()
    {
        $this->opened = $this->zip->open($this->archivePath, ZipArchive::CREATE);
        return $this->zip;
    }

    public function create()
    {
        $this->open();
        foreach ($this->config['source']['databases'] as $database) {
            $filename = $database . '-dump.sql';
            $this->zip->addFile($this->config['temporaryDirectory'] . $filename, $filename);
        }

        $this->closeIfOpened();
        return $this;
    }

    public function sendToDestinations()
    {
        $content = file_get_contents($this->archivePath);

        foreach ($this->config['destination']['disks'] as $disk) {
            $storage = \Storage::disk($disk);
            $storage->put('backups/' . $this->archiveName, $content);
        }

        return $this;
    }

    public function delete()
    {
        unlink($this->archivePath);
    }

    public function unpack()
    {
        $fs = new Filesystem;
        $storage = \Storage::disk($this->config['destination']['disks'][0]);
        $files = collect($storage->files('backups'));
        $file = $storage->path($files->last());
        $this->archivePath = $file;
        $now = now()->format('Y-m-d_H_i');
        $dest = $this->config['temporaryDirectory'] . $now . '/';
        $this
            ->open()
            ->extractTo($dest);
        return $dest;
    }

    public function closeIfOpened()
    {
        if ($this->opened) {
            $this->zip->close();
            $this->opened = false;
        }
        return $this;
    }
}
