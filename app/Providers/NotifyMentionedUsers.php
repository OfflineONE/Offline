<?php

namespace App\Providers;

use App\Notifications\YouWereMentioned;
use App\Providers\ThreadReceivedNewReply;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyMentionedUsers
{
    public function handle(ThreadReceivedNewReply $event)
    {
        $users = User::whereIn('name', $event->reply->mentionedUsers())
                ->get()
                ->each(function ($user) use ($event) {
                    $user->notify(new YouWereMentioned($event->reply));
                });
//                ->each(fn($user) => $user->notify(new YouWereMentioned($event->reply)));
//        dd($users);

    }
}
