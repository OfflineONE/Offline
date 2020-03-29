{{--Editing the question; down is the sam HTML mark up but for not editing the question--}}
<div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light mt-2"
     v-if="editing"

    >
    <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">
        <div class="level">

            <input  class="border rounded form-control"
                    type="text"
                    v-model="form.title"
            >

        </div>
    </div>

    <div class="form-group">
        <wysiwyg v-model="form.body"></wysiwyg>
    </div>

    <div class="panel-footer level">

        <button type="submit"
                class="border py-1 px-4 rounded bg-primary"
                @click="update"
            >
            Update
        </button>

        <button type="submit"
                class="border py-1 ml-2 px-4 rounded bg-transparent"
                @click="resetForm"
        >
            Cancel
        </button>

        @can('update', $thread)
            <form action="{{ $thread->path() }}"
                  method="POST"
                  class="ml-auto"
            >
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="border py-1 px-4 rounded bg-danger">
                    Delete Thread
                </button>
            </form>
        @endcan
    </div>

</div>



{{--Viewing the question--}}
<div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light mt-2"
     v-else >
    <div class="py-3 px-6 mb-0 border-b-2">
        <div class="level">
            <img src="{{ asset($thread->owner->avatar_path) }}"
                 alt="{{ $thread->owner->name }}"
                 class="mr-1"
                 width="25"
                 height="25"
            >

            <span class="flex">
                    <a href="{{ route('profile.show', $thread->owner)}}">
                        {{ $thread->owner->name }}  ({{ $thread->owner->reputation }} XP)
                    </a>
                        posted:
                         <span v-text="title">

                         </span>
                </span>
        </div>
    </div>

    <div ref="question" class="flex-auto p-6" v-html="body"></div>

    <div class="panel-footer"
         v-if="authorize('owns', thread)">
        <button @click="editing = true" class="rounded border ml-2 mb-2 p-1">Edit</button>
    </div>

</div>
