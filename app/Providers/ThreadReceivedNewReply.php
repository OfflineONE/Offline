<?php

namespace App\Providers;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ThreadReceivedNewReply
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reply;

    /**
     * ThreadReceivedNewReply constructor.
     * @param $reply
     */
    public function __construct($reply)
    {
        $this->reply = $reply;
    }
}
