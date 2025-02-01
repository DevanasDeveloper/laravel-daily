<?php

namespace App\Listeners;

use App\Events\SendMailEvent;
use App\Jobs\SendMailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMailListner
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendMailEvent $event): void
    {
        SendMailJob::dispatch($event->details,$event->subject);       
    }
}
