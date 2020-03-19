@forelse($threads as $thread)
    <div class="mt-2 bg-white rounded">
{{--        border-grey-light relative flex flex-col min-w-0 break-words border --}}
        <div class="py-3 px-6">
{{--            px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest--}}
            <div class="level">
                <div class="flex align-items-md-center">
                    <h4 class="mr-2 ">
                        <a   href="{{ $thread->path() }}">
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
