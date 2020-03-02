<?php

namespace App\Events;
use App\Client;
use Illuminate\Foundation\Events\Dispatchable;
class MailEvent extends Event
{
    // use Dispatchable, InteractWithSockets, SerializeModels;
    public $client;
    public $response;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Client $client, $response)
    {
        $this->client = $client;
        $this->response = $response;
    }
}
