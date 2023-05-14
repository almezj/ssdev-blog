<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Everything Tech') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/custom_styles.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>
<body class="h-screen antialiased leading-none font-sans">
    <div id="app">
        <header class="bg-blue-100 py-6">
            <div class="container mx-auto flex justify-between items-center px-6">
                <div>
                    <a href="/" class="header__logo">{{ config('TechBlogs', 'TechBlogs') }}</a>
                </div>
                <nav class="space-x-4 text-text text-sm sm:text-base">
                    <a class="no-underline hover:underline text-text" href="/">Home</a>
                    <a class="no-underline hover:underline text-text" href="/blog">Blog</a>
                    @guest
                        <a class="no-underline hover:underline text-text" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="no-underline hover:underline text-text" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <span class="text-text">{{ Auth::user()->name }}</span>
						<a href="{{ route('favorites') }}" class="no-underline hover:underline text-text">
            Favorites
        </a>

                        <a href="{{ route('logout') }}"
                           class="no-underline hover:underline text-text"
                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    @endguest
                </nav>
            </div>
        </header>

        <div>
            @yield('content')
        </div>

        <div>
            @include('layouts.footer')
        </div>
    </div>
</body>
</html>