<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class LockedThreadsController extends Controller
{
    public function store(Thread $thread)
    {
        $thread->update(['locked' => TRUE]);
    }

    public function destroy(Thread $thread)
    {
        $thread->update(['locked' => FALSE]);
    }



}
