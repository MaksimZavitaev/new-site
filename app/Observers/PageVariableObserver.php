<?php

namespace App\Observers;

use App\Models\PageVariable;
use App\Models\Variable;
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

    public function deleting(PageVariable $pageVariable)
    {
        $variables = $pageVariable->variables;
        if ($variables) {
            Variable::whereIn('id', $variables->pluck('id'))->delete();
        }
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
