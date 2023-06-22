<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Studiju darbs</title>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://code.jquery.com/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script src="/main.js"></script>
        <link rel="stylesheet" href="/main.css"/>
        <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_API_KEY')}}&callback=initMap&libraries=marker&v=beta"></script>
    </head>
    <body>
        @if (Route::has('login'))
            <nav>
                <h1><em>Liepāja laika griezumā</em></h1>
                @auth
                    <a href="{{ url('/dashboard') }}">Katalogs</a>
                @else
                    <a href="{{ route('login') }}">Ienākt</a>
                @endauth
            </nav>
        @endif

        <main>
            <div id="content">
                <div id="info">
                    <div id="info-image"></div>
                    <div id="info-year"></div>
                    <div><h2 id="info-name"></h2></div>
                    <div>
                        <h4 id="info-description-header">Foto apraksts:</h4>
                        <div id="info-description"></div>
                    </div>
                </div>
                <div id="map-container">
                    <div id="map"></div>
                    <div id="range">
                        <div class="slider-year">{{$min}}</div>
                        <div id="slider-range"></div>
                        <div class="slider-year">{{$max}}</div>

                        <input type="hidden" id="from" value="{{$min}}">
                        <input type="hidden" id="to" value="{{$max}}">
                    </div>
                </div>
            </div>
        </main>
        <footer></footer>
    </body>
</html>
