<reply :attributes="{{ $reply }}" inline-template v-cloak>

<div id="reply-{{ $reply->id }}"
     class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light mt-2">
    <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">
        <div class="level">
            <h5 class="flex">
                    <a href="{{ route('profile.show', $reply->owner) }}">
                        {{ $reply->owner->name }}
                </a> said {{ $reply->created_at->diffForHumans(null, 0) }} ...
            </h5>
            @if (Auth::check())
                <div>
                    <favorite :reply="{{ $reply }}"></favorite>
                </div>
            @endif
        </div>
    </div>

        <div class="flex-auto p-6">
            <div v-if="editing">

                <div class="mb-4">
                    <textarea class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded"
                              v-model="body"></textarea>
                </div>

                <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline py-1 px-2 text-sm leading-tight text-blue-lightest bg-blue hover:bg-blue-light"
                        @click="update"
                >Update</button>

                <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline py-1 px-2 text-sm leading-tight font-normal blue bg-transparent"
                        @click="editing = false"
                >Cancel</button>

            </div>

            <div v-else v-text="body"></div>

        </div>

    @can('update', $reply)
        <div class="py-3 px-6 bg-grey-lighter border-t-1 border-grey-light level">

            <button
                class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline py-1 px-2 text-sm leading-tight"
                @click="editing = true">Edit</button>

            <button
                class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-red-lightest bg-red hover:bg-red-light py-1 px-2 text-sm leading-tight"
                @click="destroy"
            >
                Delete
            </button>
    </div>
    @endcan

</div>

</reply>
