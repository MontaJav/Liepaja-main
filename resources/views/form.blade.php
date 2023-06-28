<x-app-layout>
    <link rel="stylesheet" href="/form.css"/>
    <script src="/form.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_API_KEY')}}&callback=initMap&libraries=marker&v=beta"></script>

    <div class="container">
        <form action="/save/@if(isset($photo)){{$photo->id}}@endif" method="post" enctype="multipart/form-data">
            @csrf
            
            @if (isset($photo))
                <input type="hidden" name="id" value="{{$photo->id}}">
            @endif

            @if (isset($photo))
                <img src="/images/{{$photo->image}}"/>
            @endif

            <input type="file" name="image" @if (!isset($photo)) required @endif>
            <hr>
            <div id="arrow-container">
                <input name="direction_deg_from_north" type="number" min="0" max="359" placeholder="Grādi no Ziemeļiem"
                    required @if(isset($photo))value="{{$photo->direction_deg_from_north}}"@endif
                    onchange="updateArrow(this.value)"
                >
                <div id="arrow" @if(isset($photo))style="rotate:{{$photo->direction_deg_from_north}}deg;"@endif>↑</div>
            </div>
            <input type="text" name="name" placeholder="Nosaukums" required @if(isset($photo))value="{{$photo->name}}"@endif>
            <input type="number" name="year" placeholder="Gads" required @if(isset($photo))value="{{$photo->year}}"@endif>

            <textarea name="description" placeholder="Apraksts" rows="5">@if(isset($photo)){{$photo->description}}@endif</textarea>

            <input type="hidden" name="latitude" id="latitude" @if(isset($photo))value="{{$photo->latitude}}"@endif>
            <input type="hidden" name="longitude" id="longitude" @if(isset($photo))value="{{$photo->longitude}}"@endif>
            <input type="hidden" id="mapId" value="{{env('GOOGLE_MAP_ID')}}">

            <button type="submit">Saglabāt</button>
        </form>
        <div id="map"></div>
    </div>
</x-app-layout>
