<?php


namespace App\Library\Backup;


class Zip
{
    protected $config;
    protected $zip;
    protected $opened = false;
    protected $archivePath;
    protected $archiveName;

    public function __construct($archiveName = null)
    {
        $this->config = config('backup');
        $this->zip = new \ZipArchive;

        $this->archiveName = $archiveName ?? now()->format($this->config['format']) . '.zip';
        $this->archivePath = $this->config['temporaryDirectory'] . $this->archiveName;
    }

    public function open()
    {
        $this->opened = $this->zip->open($this->archivePath, \ZipArchive::CREATE);
        return $this->zip;
    }

    public function create()
    {
        $this->open();
        foreach ($this->config['source']['databases'] as $database) {
            $filename = $database . '.sql';
            $this->zip->addFile($this->config['temporaryDirectory'] . $filename, $filename);
        }

        return $this;
    }

    public function addFiles($files)
    {
        foreach ($files as $file) {
            $this->zip->addFile(base_path() . $file, ltrim($file, DIRECTORY_SEPARATOR));
        }
        return $this;
    }

    public function sendToDestinations()
    {
        $this->closeIfOpened();
        $content = file_get_contents($this->archivePath);

        foreach ($this->config['destination']['disks'] as $disk) {
            $storage = \Storage::disk($disk);
            $storage->put('backups/' . $this->archiveName, $content);
        }

        return $this;
    }

    public function delete()
    {
        $this->closeIfOpened();
        unlink($this->archivePath);
    }

    public function unpack()
    {
        $storage = \Storage::disk($this->config['destination']['disks'][0]);
        if ($storage->exists('backups/' . $this->archiveName)) {
            $this->archivePath = $storage->path('backups/' . $this->archiveName);
        } else {
            $files = collect($storage->files('backups'));
            $file = $storage->path($files->last());
            $this->archivePath = $file;
        }
        $now = now()->format($this->config['format']);
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
