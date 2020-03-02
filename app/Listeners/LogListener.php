<?php

namespace App\Listeners;

use App\Events\LogEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogListener
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
     * @param  LogEvent  $event
     * @return void
     */
    public function handle(LogEvent $event)
    {
        $log = new Log([
            'type'      => 'debug',
            'message'      => $event->message,
        ]);
        $log->save();
    }
}
