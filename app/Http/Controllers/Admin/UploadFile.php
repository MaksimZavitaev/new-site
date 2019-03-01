<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploadFile extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @param $type
     *
     * @return mixed
     */
    public function __invoke(Request $request, $type)
    {
        $file = $request->file('file');
        $path = $file->store(str_plural($type), 'media');
        $storage = Storage::disk('media');

        $url = $storage->url($path);

        return [
//            'url' => $url,
            'name' => $file->getClientOriginalName(),
            'path' => str_replace(env('APP_URL'), '', $url),
            'size' => $storage->size($path),
        ];
    }
}
