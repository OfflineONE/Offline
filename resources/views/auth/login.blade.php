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
</head>

<body class="bg-gray-700">
    <div class="mt-64 container mx-auto">
        <div class="flex flex-wrap justify-center">
            <div class="md:w-2/3 pr-4 pl-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light">
                    <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{ __('Login') }}</div>

                    <div class="flex-auto p-6">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-4 flex flex-wrap">
                                <label for="name"
                                       class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">
                                    {{ __('Name') }}
                                </label>

                                <div class="md:w-1/2 pr-4 pl-4">
                                    <input id="name"
                                           type="name"
                                           class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded @error('name') bg-red-dark @enderror"
                                           name="name"
                                           value="{{ old('name') }}"
                                           required
                                           autocomplete="name"
                                           autofocus>

                                    @error('name')
                                    <span class="hidden mt-1 text-sm text-red" role="relative px-3 py-3 mb-4 border rounded">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 flex flex-wrap">
                                <label for="password" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{ __('Password') }}</label>

                                <div class="md:w-1/2 pr-4 pl-4">
                                    <input id="password" type="password" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded @error('password') bg-red-dark @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="hidden mt-1 text-sm text-red" role="relative px-3 py-3 mb-4 border rounded">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 flex flex-wrap">
                                <div class="md:w-1/2 pr-4 pl-4 md:mx-1/3">
                                    <div class="relative block mb-2">
                                        <input class="absolute mt-1 -ml-6"
                                               type="checkbox"
                                               name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}
                                        >

                                        <label class="text-grey-dark pl-6 mb-0" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 flex flex-wrap mb-0">
                                <div class="md:w-2/3 pr-4 pl-4 md:mx-1/3">
                                    <button type="submit"
                                            class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light"
                                    >
                                        {{ __('Login') }}
                                    </button>

{{--                                    @if (Route::has('password.request'))--}}
{{--                                        <a class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline font-normal blue bg-transparent" href="{{ route('password.request') }}">--}}
{{--                                            {{ __('Forgot Your Password?') }}--}}
{{--                                        </a>--}}
{{--                                    @endif--}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <flash message="{{ session('flash') }}"></flash>
</body>
</html>
