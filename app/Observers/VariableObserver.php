<?php

namespace App\Observers;

use App\Models\Variable;
use App\Services\MediaManager;

class VariableObserver
{
    /**
     * Handle the variable "created" event.
     *
     * @param  \App\Variable  $variable
     * @return void
     */
    public function created(Variable $variable)
    {
        //
    }

    /**
     * Handle the variable "updated" event.
     *
     * @param  \App\Variable  $variable
     * @return void
     */
    public function updated(Variable $variable)
    {
        //
    }

    /**
     * Handle the variable "deleted" event.
     *
     * @param  \App\Variable  $variable
     * @return void
     */
    public function deleted(Variable $variable)
    {
        if (in_array($variable->type, ['image', 'file'])) {
            app(MediaManager::class)->deleteFile($variable->data->path);
        }
    }

    /**
     * Handle the variable "restored" event.
     *
     * @param  \App\Variable  $variable
     * @return void
     */
    public function restored(Variable $variable)
    {
        //
    }

    /**
     * Handle the variable "force deleted" event.
     *
     * @param  \App\Variable  $variable
     * @return void
     */
    public function forceDeleted(Variable $variable)
    {
        //
    }
}
