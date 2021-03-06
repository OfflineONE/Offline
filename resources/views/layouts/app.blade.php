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

    <script src="/js/app.js" defer>
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" href="#" />

    <link rel="icon" href="/img/favicon.ico" type="image/x-icon"/>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

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

        #logo {
            position: fixed;
            width: 40%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>

    @yield('header')

</head>
    <body class="bg-white">
        <div id="app">

                @auth()
                    @include('layouts/nav')
                @endauth

                        @yield('content')

                @auth()
                    @include('layouts/footer')
                @endauth

            <flash message="{{ session('flash') }}"></flash>
        </div>
    </body>
</html>
