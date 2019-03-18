<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Finder\Finder;

class BackupController extends Controller
{
    public function index()
    {
        $files = Finder::create()
            ->in(storage_path('app/backups/'))
            ->files()
            ->name('*.zip')
            ->sortByName()
            ->reverseSorting();

        return view('admin.backups.index', compact('files'));
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
}
