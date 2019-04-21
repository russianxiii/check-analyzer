<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="/images/qr-ruble.png">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-grey-lightest h-screen antialiased">
    <div id="app">
        <nav class="bg-blue shadow mb-8 py-3">

            <div class="container mx-auto px-6 md:px-0">
                <div class="flex items-center justify-center">
                    <div class="mr-6">
                        <a href="{{ url('/') }}" class="text-lg font-semibold text-white no-underline">
                        <div class="flex items-center flex-no-shrink text-white mr-6">
                            <img class="fill-current h-10 w-10 mr-2" width="70" height="70" src="/images/qr-ruble.png"/></img>
                            <span class="font-semibold text-xl tracking-tight">{{ config('app.name', 'Laravel') }}</span>
                        </div>
                        </a>
                    </div>
                    <div class="flex-1 text-right">
                        @guest
                            <a class="no-underline hover:underline text-grey-lightest p-3" href="{{ route('login') }}">Войти</a>
                            <a class="no-underline hover:underline text-grey-lightest p-3" href="{{ route('register') }}">Зарегистрироваться</a>
                        @else
                            <span class="text-grey-lightest pr-4">{{ Auth::user()->name }}</span>

                            <a href="{{ route('logout') }}"
                               class="no-underline hover:underline text-grey-lightest p-3"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Выход</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>
<div id="analyzer">
    @yield('content')
</div>

    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
