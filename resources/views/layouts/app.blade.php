<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Offline') }}</title>



    <!-- Scripts -->
    <script>
        window.App = {!! json_encode(
            [
            'signedIn' => Auth::check(),
            'user' => Auth::user()
            ]) !!}
    </script>

    <script src="{{ asset('js/app.js') }}" defer>

    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" href="#" />

    <link rel="icon" href="{{ URL::asset('img/favicon.ico') }}" type="image/x-icon"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
        "padding-bottom: 100px;"
        }

        .level {
            display: flex;
            align-items: center;
        }

        .level-item {
            margin-right: 1em;
        }

        .flex {
            flex: 1;
        }

        [v-cloak] { display: none; }

        .ais-highlight > em { background: yellow; font-style: normal; }


    </style>

    @yield('header')

</head>
    <body class="bg-gray-400">
        <div id="app">
                @include('layouts/nav')
                @yield('content')
            <flash message="{{ session('flash') }}"></flash>
        </div>
    </body>
</html>
