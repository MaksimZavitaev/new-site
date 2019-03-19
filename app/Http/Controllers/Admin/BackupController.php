<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Finder\Finder;

class BackupController extends Controller
{
    public function index()
    {
        $path = storage_path('app/backups/');
        if (!\File::isDirectory($path)) {
            \File::makeDirectory($path);
        }

        $files = Finder::create()
            ->in($path)
            ->files()
            ->name('*.zip')
            ->sortByName()
            ->reverseSorting();

        return view('admin.backups.index', compact('files'));
    }

    public function create()
    {
        try {
            $code = \Artisan::call('backup:create');
        } catch (\Exception $exception) {
            $code = 1;
        }

        return response()->json(['code' => $code]);
    }

    public function restore(Request $request)
    {
        $name = $request->get('name');
        try {
            $code = \Artisan::call('backup:restore', ['name' => $name]);
        } catch (\Exception $exception) {
            $code = 1;
        }

        return json_encode(['code' => $code]);
    }

    public function destroy(Request $request)
    {
        $name = $request->get('name');
        $path = storage_path("app/backups/{$name}");
        if (\File::isFile($path)) {
            if (\File::delete($path)) {
                return response()->json(['status' => 'ok']);
            }
            return response()->json(['status' => 'error', 'message' => 'File not deleted']);
        }
        return response()->json(['status' => 'error', 'message' => 'File not found']);
    }

    public function upload(Request $request)
    {
        $file = $request->file('archive');
        $path = $file->storeAs('backups', $file->getClientOriginalName(), 'local');
        $storage = \Storage::disk('local');

        $url = $storage->url($path);

        return [
            'name' => $file->getClientOriginalName(),
            'path' => str_replace(env('APP_URL'), '', $url),
            'size' => $storage->size($path),
        ];
    }

    public function download(Request $request)
    {

    }
}
