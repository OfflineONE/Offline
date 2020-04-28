@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="grid grid-cols-2 gap-4">
            <div class="">
                @include('threads._list')
                {{ $threads->render() }}
            </div>

            <div class="">

                <div class="">
                    <div class="">
                        Search
                    </div>

                    <div class="">
                        <form method="GET"
                              action="/threads/search">
                            <input type="text"
                                   placeholder="Search for something ..."
                                   name="q"
                                   class="form-control"
                            >
                            <button
                                type="submit"
                                class="bg-primary form-control"
                            >Search</button>
                        </form>
                </div>
            </div>

                @if(count($trending))
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Trending Threads
                        </div>

                    <div class="border-blue-500 rounded-lg border-2">
                            @foreach($trending as $thread)
                            <div>
                                <a href="{{ url($thread->path) }}">
                                    {{ $thread->title }}
                                </a>
                            </div>
                            @endforeach
                    </div>

                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
