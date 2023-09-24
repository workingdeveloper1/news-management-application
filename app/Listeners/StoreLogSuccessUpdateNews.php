<?php

namespace App\Listeners;

use App\Events\SuccessUpdateNews;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreLogSuccessUpdateNews
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
    public function handle(SuccessUpdateNews $event)
    {
        //
        $log = Log::create([
            'message' => 'Success update news "'.$event->news['title'].'"'
        ]);
    }
}
