<?php

namespace App\Http\Controllers;

use App\Channel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        dd(request()->server());

        $channels = Channel::all();


        return view('home', compact('channels'));
    }
}
