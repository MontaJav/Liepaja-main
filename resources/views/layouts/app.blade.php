<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Studiju darbs') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div>
            <nav>
                <a href="/">Sākums</a>
                <a class="nav-button" href="{{ url('/dashboard')}}"></a>
                @if (Route::has('logout') && Auth::user())
                    <a href="{{ route('logout') }}">Iziet</a>
                @endif
            </nav>

            <!-- Page Heading -->
            @if (isset($header))
                <header>
                    <div>
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            <footer></footer>
        </div>
    </body>
</html>
