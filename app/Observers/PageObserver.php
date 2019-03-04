<?php

namespace App\Observers;

use App\Models\Page;
use Illuminate\Support\Facades\File;

class PageObserver
{
    /**
     * Handle the page "created" event.
     *
     * @param Page $page
     *
     * @return void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function created(Page $page)
    {
        $attributes = $page->getAttributes();
        $pages_path = resource_path('views/pages');
        $stub_file = resource_path('stubs/page.stub');
        $ext = '.blade.php';

        $link = $attributes['link'] === '/' ? '/index' : $attributes['link'];

        $this->createParentDirectory($page, $pages_path);

        $stub = File::get($stub_file);
        $viewPath = $pages_path . $link . $ext;

        $replace = [
            'DummyPageName' => $page->name,
            'DummyPageViewPath' => str_replace([base_path(), '\\'], ['', '/'], $viewPath),
        ];

        File::put(
            $viewPath,
            str_replace(
                array_keys($replace), array_values($replace),
                $stub
            )
        );
    }

    /**
     * Handle the page "updated" event.
     *
     * @param Page $page
     *
     * @return void
     */
    public function updated(Page $page)
    {
        $original = $page->getOriginal();
        $changes = $page->getChanges();

        if (array_key_exists('link', $changes)) {
            $ext = '.blade.php';

            $pages_path = resource_path('views/pages');
            $old_path = $pages_path . $original['link'] . $ext;
            $new_path = $pages_path . $changes['link'] . $ext;

            $this->createParentDirectory($page, $pages_path);

            File::move($old_path, $new_path);
        }
    }

    /**
     * Handle the page "deleted" event.
     *
     * @param Page $page
     *
     * @return void
     */
    public function deleted(Page $page)
    {
        //
    }

    /**
     * Handle the page "restored" event.
     *
     * @param Page $page
     *
     * @return void
     */
    public function restored(Page $page)
    {
        //
    }

    /**
     * Handle the page "force deleted" event.
     *
     * @param Page $page
     *
     * @return void
     */
    public function forceDeleted(Page $page)
    {
        //
    }

    /**
     * @param Page $page
     * @param string $pages_path
     *
     * @return bool
     */
    protected function createParentDirectory(Page $page, string $pages_path)
    {
        $parent = $page->parent->only('link');

        $path = $pages_path . $parent['link'];

        if (!File::isDirectory($path)) {
            return File::makeDirectory($path, 0755, true);
        }
        return true;
    }
}
