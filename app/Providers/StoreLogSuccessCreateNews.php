<?php

namespace App\Providers;

use App\Providers\SuccessCreateNews;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreLogSuccessCreateNews
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Providers\SuccessCreateNews  $event
     * @return void
     */
    public function handle(SuccessCreateNews $event)
    {
        //
    }
}
