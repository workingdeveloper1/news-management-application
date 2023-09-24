<?php

namespace App\Listeners;

use App\Events\SuccessDeleteNews;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreLogSuccessDeleteNews
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
    public function handle(SuccessDeleteNews $event)
    {
        //
        $log = Log::create([
            'message' => 'Success delete news "'.$event->news['title'].'"'
        ]);
    }
}
