@forelse($threads as $thread)
    <div class="mt-2 bg-white rounded">
{{--        border-grey-light relative flex flex-col min-w-0 break-words border --}}
        <div class="py-3 px-6">
{{--            px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest--}}
            <div class="level">
                <div class="flex align-items-md-center">
                    <h4 class="mr-2">
                        <a class="level" href="{{ $thread->path() }}">
                            @if ($thread->pinned)
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 463 463" width="24" height="24" stroke="#000" stroke-width="0">
                                    <path d="M303.5 208h-1.151L287.582 45.568C296.571 42.265 303 33.62 303 23.5 303 10.542 292.458 0 279.5 0h-96C170.542 0 160 10.542 160 23.5c0 10.12 6.429 18.765 15.418 22.068L160.651 208H159.5c-12.958 0-23.5 10.542-23.5 23.5s10.542 23.5 23.5 23.5H224v200.5c0 4.143 3.357 7.5 7.5 7.5s7.5-3.357 7.5-7.5V255h64.5c12.958 0 23.5-10.542 23.5-23.5S316.458 208 303.5 208zm-120-193h96c4.687 0 8.5 3.813 8.5 8.5s-3.813 8.5-8.5 8.5h-96c-4.687 0-8.5-3.813-8.5-8.5s3.813-8.5 8.5-8.5zm6.849 32h82.303l14.636 161H175.712l14.637-161zM303.5 240h-144c-4.687 0-8.5-3.813-8.5-8.5s3.813-8.5 8.5-8.5h144c4.687 0 8.5 3.813 8.5 8.5s-3.813 8.5-8.5 8.5z" stroke="none"/>
                                </svg>
                            @endif
                            @if(auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                                <strong style="color: #2212ff">
                                    {{$thread->title}}
                                </strong>
                            @else
                                <strong style="color: #8fb4ff">
                                    {{ $thread->title }}
                                </strong>
                            @endif
                        </a>
                    </h4>

                    <strong class="text-xs">Posted By: <a href="{{ route('profile.show', $thread->owner->name) }}">{{ $thread->owner->name }}</a></strong>
                </div>

                <a href="{{ $thread->path() }}">{{ $thread->getReplyCountAttribute() }} {{ Str::plural('reply', $thread->getReplyCountAttribute()) }}</a>
            </div>
        </div>

        <div class="flex-auto p-6">
{{--            @if (session('status'))--}}
{{--                <div class="relative px-3 py-3 mb-4 border rounded text-green-darker border-green-dark bg-green-lighter" role="alert">--}}
{{--                    {{ session('status') }}--}}
{{--                </div>--}}
{{--            @endif--}}

            <div class="panel-body">
                <div class="body">{!! $thread->body !!}</div>
            </div>

        </div>
            <div class="panel-footer p-6">
                {{ $thread->visits }} visits
            </div>
    </div>
@empty

    <br>
    <br>
    <br>
    <p>Madame/Sir,</p>
    <br>

    <p> Could you please step aside? There is absolutely</p>
    <p>NOTHING</p>
    <p>to see in here. Please go offline and create something to show in here.</p>
@endforelse
