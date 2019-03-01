<?php

namespace App\Observers;

use App\Models\Media;

class MediaObserver
{
    /**
     * Handle the media "created" event.
     *
     * @param  \App\Models\Media  $media
     * @return void
     */
    public function created(Media $media)
    {
        //
    }

    /**
     * Handle the media "updated" event.
     *
     * @param  \App\Models\Media  $media
     * @return void
     */
    public function updated(Media $media)
    {
        //
    }

    /**
     * Handle the media "deleted" event.
     *
     * @param  \App\Models\Media  $media
     * @return void
     */
    public function deleted(Media $media)
    {
        //
    }

    /**
     * Handle the media "restored" event.
     *
     * @param  \App\Models\Media  $media
     * @return void
     */
    public function restored(Media $media)
    {
        //
    }

    /**
     * Handle the media "force deleted" event.
     *
     * @param  \App\Models\Media  $media
     * @return void
     */
    public function forceDeleted(Media $media)
    {
        //
    }
}
