<?php

namespace App\Observers;

use App\Models\PageVariable;
use App\Services\MediaManager;

class PageVariableObserver
{
    /**
     * Handle the page variable "created" event.
     *
     * @param PageVariable $pageVariable
     *
     * @return void
     */
    public function created(PageVariable $pageVariable)
    {
        //
    }

    /**
     * Handle the page variable "updated" event.
     *
     * @param PageVariable $pageVariable
     *
     * @return void
     */
    public function updated(PageVariable $pageVariable)
    {
        //
    }

    /**
     * Handle the page variable "deleted" event.
     *
     * @param PageVariable $pageVariable
     *
     * @return void
     */
    public function deleted(PageVariable $pageVariable)
    {
        if (in_array($pageVariable->type, ['image', 'file'])) {
            app(MediaManager::class)->deleteFile($pageVariable->data->path);
        }
    }

    /**
     * Handle the page variable "restored" event.
     *
     * @param PageVariable $pageVariable
     *
     * @return void
     */
    public function restored(PageVariable $pageVariable)
    {
        //
    }

    /**
     * Handle the page variable "force deleted" event.
     *
     * @param PageVariable $pageVariable
     *
     * @return void
     */
    public function forceDeleted(PageVariable $pageVariable)
    {
        //
    }
}
