<?php

namespace App\Http\Controllers\Admin;

use App\Channel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ChannelsController extends Controller
{
    /**
     * Show all channels.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $channels = Channel::withArchived()->withCount('threads')->get();

        return view('admin.channels.index', compact('channels'));
    }

    public function create()
    {
        return view('admin.channels.create', ['channel' => new Channel]);
    }

    /**
     * Show the form to edit an existing channel.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $channels = Channel::withArchived()->get();
        $channel = Channel::withArchived()->where('slug', $slug)->first();

        return view('admin.channels.edit', compact('channel'), compact('channels'));
    }

    public function update(Channel $channel)
    {
        $channel->update(
            request()->validate([
                'name' => ['required', Rule::unique('channels')->ignore($channel)],
                'description' => 'required',
                'archived' => 'required|boolean'
            ])
        );

        cache()->forget('channels');

        if (request()->wantsJson()) {
            return response($channel, 200);
        }

        return redirect(route('admin.channels.index'))
            ->with('flash', 'Your channel has been updated!');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|unique:channels',
            'description' => 'required',
        ]);

        $channel = Channel::create($data + ['slug' => str::slug($data['name'])]);

        Cache::forget('channels');

        if (request()->wantsJson()) {
            return response($channel, 201);
        }

        return redirect(route('admin.channels.index'))
            ->with('flash', 'Your channel has been created!');
    }
}
