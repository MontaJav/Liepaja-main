document.addEventListener("DOMContentLoaded", () => {
    search();
});

function search(from, to) {
    if (!from || !to) {
        return;
    }
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "/photos/" + from + '/' + to, false);
    xhttp.send();
    const response = JSON.parse(xhttp.responseText);
    if (response.length) {
        initMap(response);
        setInfo(response[0]);
    }
}

function setInfo(photo) {
    document.getElementById('info-image').innerHTML = '<img src="/images/' + photo.image + '"/>';
    document.getElementById('info-year').innerHTML = photo.year;
    document.getElementById('info-name').innerHTML = photo.name;
    document.getElementById('info-description').innerHTML = photo.description ?? '';
}

function initMap(photos) {
    if (!photos) {
        return;
    }

    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 10,
        center: {'lat': parseFloat(photos[0].latitude), 'lng': parseFloat(photos[0].longitude)},
    });

    let bounds = new google.maps.LatLngBounds();

    // Create the markers.
    photos.forEach((photo) => {
        const marker = new google.maps.Marker({
            position: {'lat': parseFloat(photo.latitude), 'lng': parseFloat(photo.longitude)},
            map,
            title: photo.title,
            optimized: false,
            info: photo,
        });

        // Add a click listener for each marker, and set up the info window.
        marker.addListener("click", () => {
            setInfo(marker.info);
        });

        bounds.extend(marker.getPosition());
    });

    map.fitBounds(bounds);
}

$( function() {
    $( "#slider-range" ).slider({
        range: true,
        min: parseInt($('#from').val()),
        max: parseInt($('#to').val()),
        values: [ parseInt($( "#from" ).val()), parseInt($( "#to" ).val()) ],
        slide: function( event, ui ) {
            $('.ui-slider-handle')[0].innerHTML = ui.values[ 0 ];
            $('.ui-slider-handle')[1].innerHTML = ui.values[ 1 ];
            search(ui.values[ 0 ], ui.values[ 1 ]);
        }
    });
    $('.ui-slider-handle')[0].innerHTML = $('#from').val();
    $('.ui-slider-handle')[1].innerHTML = $('#to').val();
    search(parseInt($('#from').val()), parseInt($('#to').val()));
} );
