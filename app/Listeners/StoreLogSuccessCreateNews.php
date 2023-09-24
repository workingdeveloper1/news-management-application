<?php

namespace App\Listeners;

use App\Events\SuccessCreateNews;
use App\Models\Log;
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
     * @param  object  $event
     * @return void
     */
    public function handle(SuccessCreateNews $event)
    {
        //
        $log = Log::create([
            'message' => 'Success create news "'.$event->news['title'].'"'
        ]);
    }
}
