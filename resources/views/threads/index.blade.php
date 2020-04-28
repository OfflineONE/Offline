@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="grid grid-cols-2 gap-4">
            <div class="">
                @include('threads._list')
                {{ $threads->render() }}
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
