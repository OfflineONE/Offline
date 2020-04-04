<?php

namespace App\Http\Controllers\Api;

use App\Channel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ChannelsController extends Controller
{
    /**
     * Fetch all channels.
     */
    public function index()
    {
        return Cache::rememberForever('channels', function () {
            return Channel::all();
        });
    }
}
