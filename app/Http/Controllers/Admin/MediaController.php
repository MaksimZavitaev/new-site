<?php

namespace App\Http\Controllers\Admin;

use App\Models\Media;
use App\Services\MediaManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class MediaController extends Controller
{
    /**
     * @var MediaManager
     */
    private $mediaManager;

    public function __construct(MediaManager $mediaManager)
    {
        $this->mediaManager = $mediaManager;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return Media[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        $path = $request->get('path', '/');
        return $this->mediaManager->folderInfo($path);
    }

    public function upload(Request $request)
    {
        $files = $request->file('files');

        if (!$files) {
            return true;
        }

        $folder = $request->get('folder', '/');
        $hash = true;//(bool) $request->get('hash', false);

        $result = $this->mediaManager->saveUploadedFiles($files, $folder, $hash);

        return $result->count() > 1 ? $result : $result[0];
    }

    public function deleteFile(Request $request)
    {
        $path = $request->get('path');

        $result = $this->mediaManager->deleteFile($path);

        return [
            'result' => $result,
        ];
    }

    public function createFolder(Request $request)
    {
        $folder = $request->get('folder', '/') . $request->get('name');

        $result = $this->mediaManager->createDirectory($folder);

        return [
            'result' => $result,
        ];
    }

    public function deleteFolder(Request $request)
    {
        $folder = $request->get('path');

        $result = $this->mediaManager->deleteDirectory($folder);

        return [
            'result' => $result,
        ];
    }

    public function rename(Request $request)
    {

    }
}
