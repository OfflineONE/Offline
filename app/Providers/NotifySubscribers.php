<?php

namespace App\Providers;

class NotifySubscribers
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
     * @param  ThreadReceivedNewReply  $event
     * @return void
     */
    public function handle(ThreadReceivedNewReply $event)
    {
        $thread = $event->reply->thread->subscriptions
            ->where('user_id', '!=', $event->reply->user_id)
            ->each
            ->notify($event->reply);
    }
}
