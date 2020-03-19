@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="grid grid-cols-2 gap-4">
            <div class="">
                @include('threads._list')
                {{ $threads->render() }}
            </div>

            <div class="col-md-8">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Search
                    </div>

                    <div class="panel-body form-group">
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

                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach($trending as $thread)
                                    <li class="list-group-item">
                                        <a href="{{ url($thread->path) }}">
                                            {{ $thread->title }}
                                        </a>
                                    </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
