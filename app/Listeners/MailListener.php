<?php

namespace App\Listeners;

use App\Events\MailEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailListener
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
     * @param  ExampleEvent  $event
     * @return void
     */
    public function handle(MailEvent $event)
    {
        $data = array(
                    'name'  => $event->client->firstname,
                    'data'  => $event->response,
                    'email'=>$event->client->email
                );
        $send = Mail::send('mail', $data, function($message) use ($data){
                $from = 'istiqomah2018@gmail.com';
                $client = array();
                    $message->to($data['email'], $data['name'])
                            ->subject("Test Email from Me");
                    $message->from($from, 'Istiqomah NF');
                });
    }
}
