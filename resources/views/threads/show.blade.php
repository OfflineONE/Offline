@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="/css/vendor/jquery.atwho.css">
@endsection

@section('content')
<thread-view
             :thread="{{ $thread }}"
             inline-template

>
    <div class="container mx-auto">
        <div class="flex flex-wrap">
{{--            // v-cloak is important to not show freatures a millisecond preload before page laod--}}
            <div class="w-2/3 pr-4 pl-4 v-cloak">

               @include('threads._question')

                <replies
                         @added="repliesCount++"
                         @remove="repliesCount--"></replies>

            </div>
            <div class="w-1/3 pr-4 pl-4">
                <div class="flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light">
                    <div class="flex-auto p-6">
                        <p>
                            This thread was published {{ $thread->created_at->diffForHumans() }} by
                                <a href="{{ $thread->owner->path }}">
                                    {{ $thread->owner->name }}
                                </a>, and currently has
                            <span v-text="repliesCount">

                            </span> {{ Str::plural('comment', $thread->replies_count) }}.
                        </p>
                        <p>
                            <subscribe-button :active="{{ json_encode($thread->isSubscribedTo) }}"></subscribe-button>

                            <button :class="classes(locked)"
                                    v-if="authorize('isAdmin')"
                                    @click="toggleLock"
                                    v-text="locked ? 'Unlock' : 'Lock'">Lock thread</button>

                            <button :class="classes(pinned)"
                                    v-if="authorize('isAdmin')"
                                    @click="togglePin"
                                    v-text="pinned ? 'Unpin' : 'Pin'"></button>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</thread-view>
@endsection
