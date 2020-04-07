@extends('layouts.app')

@section('content')
    <ais-index
    app-id="{{ config('scout.algolia.id') }}"
    api-key="{{ config('scout.algolia.key') }}"
    index-name="threads"
    query="{{ request('q') }}"
    >
        <div class="flex py-6">
            <div class="flex-initial">
                <div class="">
                    Search Threads ...
                </div>

                <div class="form-control">
                    <ais-search-box>
                        <ais-input :autofocus="true" placeholder="Find a thread ..." class=""></ais-input>
                    </ais-search-box>
                </div>
            </div>

            <div class="flex-1">
                <div class="">
                    Filter by channel
                </div>

                <div class="">
                    <ais-refinement-list attribute-name="channel.name" :autofocus="true"></ais-refinement-list>
                </div>
            </div>



            @if(count($trending))
                <div class="flex-1">
                    <div class="">
                        Trending Threads
                    </div>

                    <div class="">
                        <ul class="">
                            @foreach($trending as $thread)
                                <li class="">
                                    <a href="{{ url($thread->path) }}">
                                        {{ $thread->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            @endif
        </div>

        <ais-results>
                <template scope="{ result }">
                    <li>
                        <a :href="result.path">
                            <ais-highlight :result="result" attribute-name="title"></ais-highlight>
                        </a>
                    </li>
                </template>
            </ais-results>

    </ais-index>
@endsection
