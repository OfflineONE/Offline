<?php

namespace App\Http\Controllers\Admin;

use App\Channel;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $channels = Channel::all();

        return view('admin.dashboard.index', compact('channels'));
    }
}
