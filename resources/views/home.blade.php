@extends('layouts.app')

@section('content')

    <div class="h-screen bg-gray-700 overflow-hidden ">
        <div class="z-0 bg-gray-800 h-screen"></div>
        <div class="z-0 bg-gray-200 h-screen"></div>
        <div class="z-0 bg-gray-800 h-screen"></div>
        <a href="/login">
            <img
                    id="logo"
                    src="/img/offline.svg"
                    alt=""
                    class=""
            >
        </a>
    </div>


@endsection

