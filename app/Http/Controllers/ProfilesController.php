<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Channel;
use App\User;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        $channels = Channel::all();

        return view('profiles.show', [
            'profileUser' => $user,
            'activities' => Activity::feed($user),
            'channels' => $channels
        ]);
    }
}
