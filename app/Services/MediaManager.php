<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MediaManager
{
    /**
     * @var \Illuminate\Contracts\Filesystem\Filesystem
     */
    protected $disk;

    /**
     * @var string
     */
    private $diskName;

    private $errors = [];

    public function __construct()
    {
        $this->diskName = 'media';
        $this->disk = Storage::disk($this->diskName);
    }

    public function folderInfo($folder)
    {
        $folder = $this->cleanFolder($folder);
        
        $subFolders = collect($this->disk->directories($folder))->reduce(function ($subFolders, $subFolder) {
            if (!$this->isItemHidden($subFolder)) {
                $subFolders[] = $this->folderDetails($subFolder);
            }

            return $subFolders;
        }, collect([]));

        $files = collect($this->disk->files($folder))->reduce(function ($files, $path) {
            if (!$this->isItemHidden($path)) {
                $files[] = $this->fileDetails($path);
            }

            return $files;
        }, collect([]));

        $itemsCount = $subFolders->count() + $files->count();

        return compact('folder', 'subFolders', 'files', 'itemsCount');
    }

    public function saveUploadedFiles($files, $path = '/', $hash = false)
    {
        $result = [];
        foreach ($files ?: [] as $file) {
            $result[] = $this->saveUploadedFile($file, $path, $hash);
        }

        return collect($result);
    }

    public function saveUploadedFile(UploadedFile $file, $path = '/', $hash = false) {
        if($hash) {
            $fileName = $file->hashName();
        } else {
            $fileName = $file->getClientOriginalName();
        }

        if($this->disk->exists($path . $fileName)) {
            // :TODO File already exists
        }

        $path = $file->storeAs($path, $fileName, [
            'disk' => $this->diskName,
            'visibility' => 'public',
        ]);

        if(!$path) {
            // :TODO File is not saved
        }

        return [
            'url' => str_replace(env('APP_URL'), '', $this->disk->url($path)),
            'path' => $path,
            'size' => $this->disk->size($path),
        ];
    }

    public function createDirectory($folder)
    {
        $folder = $this->cleanFolder($folder);
        if ($this->disk->exists($folder)) {
            $this->errors[] = "Folder ${folder} exists";
            return false;
        }

        return $this->disk->makeDirectory($folder);
    }

    public function deleteDirectory($folder)
    {
        $folder = $this->cleanFolder($folder);
        $folderFiles = array_merge($this->disk->directories($folder), $this->disk->files($folder));
        if (!empty($folderFiles)) {
            $this->errors[] = 'The directory must be empty to delete it.';
            return false;
        }
        return $this->disk->deleteDirectory($folder);
    }

    public function deleteFile($path)
    {
        $path = $this->cleanFolder($path);
        if (!$this->disk->exists($path)) {
            $this->errors[] = 'File does not exist.';
            return false;
        }

        return $this->disk->delete($path);
    }

    public function fileModified($path)
    {
        try {
            return Carbon::createFromTimestamp($this->disk->lastModified($path));
        } catch (\Exception $e) {
            return Carbon::now();
        }
    }
    
    public function fileSize($path)
    {
        return $this->disk->size($path);
    }
    
    public function fileWebpath($path)
    {
        $path = $this->disk->url($path);
        // Remove extra slashes from URL without removing first two slashes after http/https:...
        $path = preg_replace('/([^:])(\/{2,})/', '$1/', $path);
        return $path;
    }

    protected function cleanFolder($folder)
    {
        return DIRECTORY_SEPARATOR . trim(str_replace('..', '', $folder), DIRECTORY_SEPARATOR);
    }

    protected function folderDetails($path)
    {
        $path = '/'.ltrim($path, '/');
        return [
            'name'     => basename($path),
            'mimeType' => 'folder',
            'fullPath' => $path,
            'modified' => $this->fileModified($path),
        ];
    }

    protected function fileDetails($path)
    {
        $path = '/'.ltrim($path, '/');
        return [
            'name'         => basename($path),
            'fullPath'     => $path,
            'webPath'      => $this->fileWebpath($path),
            'mimeType'     => 'file',//$this->fileMimeType($path),
            'size'         => $this->fileSize($path),
            'modified'     => $this->fileModified($path),
        ];
    }

    private function isItemHidden($item)
    {
        return starts_with(last(explode(DIRECTORY_SEPARATOR, $item)), '.');
    }
}
