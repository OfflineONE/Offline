<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Filters\ThreadFilters;
use App\Thread;
use App\Trending;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ThreadsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Channel $channel, ThreadFilters $filters, Trending $trending)
    {
        $threads = $this->getThreads($channel, $filters);

        if (request()->wantsJson()) {
            return $threads;
        }

        $trending->get();

        $channels = Channel::all();

        return view('threads.index', [
            'threads' => $threads,
            'trending' => $trending->get(),
            'channels' => $channels
        ]);
    }

    public function create()
    {
        return view('threads.create', [
            'channels' => Channel::orderBy('name', 'asc')->get()
        ]);
    }

    public function store(Request $request)
    {
        request()->validate(
            [
                'title' => 'required|spamfree',
                'body' => 'required|spamfree',
                'channel_id' => [
                    'required',
                    Rule::exists('channels', 'id')->where(function ($query) {
                        $query->where('archived', false);
                    }),
                ],
            ]);

        $thread = Thread::create([
            'user_id' => auth()->id(),
            'channel_id' => request('channel_id'),
            'title' => request('title'),
            'body' => request('body'),
        ]);

        if (request()->wantsJson()) {
            return response($thread, 201);
        }

        return redirect($thread->path())
                        ->with('flash', 'Your thread has been published');
    }

    public function destroy($channel, Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->delete(); //replies are deleted in the threads model

        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect('/login')
                ->with('flash');
    }

    public function show($channel, Thread $thread, Trending $trending)
    {
        if (auth()->check()) {
            auth()->user()->read($thread);
        }

        $trending->push($thread);

        $thread->increment('visits');

        $channels = Channel::all();

        return view('threads.show', compact('thread', 'channels'));
    }

    public function edit(Thread $thread)
    {
    }

    public function update($channel, Thread $thread)
    {
        $this->authorize('update', $thread);
        $thread->update(request()->validate(['title' => 'required|spamfree',
            'body'  => 'required|spamfree',
        ]));
    }

    protected function getThreads(Channel $channel, ThreadFilters $filters)
    {
        $threads = Thread::orderBy('pinned', 'DESC')
            ->latest()
            ->filter($filters);

        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }

        return $threads->paginate(25);
    }
}
