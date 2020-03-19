<?php

namespace App\Policies;

use App\Reply;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Reply $reply)
    {
        return $reply->user_id == $user->id;
    }

    public function create(User $user)
    {
        if (!($user->fresh()->lastReply)) {
            return true;
        }

        return ! $user->fresh()->lastReply->wasJustPublished();
    }
}
