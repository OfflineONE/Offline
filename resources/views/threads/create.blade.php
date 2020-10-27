@extends('layouts.app')

@section('content')
    <div class="mt-4">
        <div class="flex flex-wrap justify-center">
            <div class="w-2/3 pr-4 pl-4">
                <div class="flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light">
                    <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">Create a new thread</div>

                    <div class="flex-auto p-6">
                        <form action="/threads"
                              method="POST">
                            @csrf

        <div class="mb-4">
                <label for="channel_id">Chose a category:</label>
                    <select name="channel_id"
                            id="channel_id"
                            class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" required>
                        <option value="">Choose One ...</option>
{{--                        //under App service provider we are loading the query--}}
                        @foreach($channels as $channel)
                            <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                        @endforeach
                    </select>
        </div>

                            <div class="mb-4">
                                <label for="title">Title:</label>
                                <input type ="text"
                                       class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded"
                                       name="title"
                                       id="title"
                                       placeholder=""
                                       value="{{ old('title') }}"
                                       required>
                            </div>

                            <div class="mb-4">
                                <label for="body">Body:</label>
                                <wysiwyg name="body"></wysiwyg>
{{--                                <textarea name="body"--}}
{{--                                          rows="8"--}}
{{--                                          type=""--}}
{{--                                          class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded"--}}
{{--                                          id="body"--}}
{{--                                          placeholder=""--}}
{{--                                          required--}}
{{--                                         >{{ old('body') }}</textarea>--}}
                            </div>

                            <add-location></add-location>

                            <div class="mb-4">
                            <button type="submit"
                                    class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-default bg-blue">
                                Publish</button>
                        </div>


                            @if(count($errors))
                                <ul class="px-3 py-3 mb-4 border rounded text-red-darker border-red-dark bg-red-300">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
