function initMap() {
    const currentLatitude = document.getElementById("latitude").value;
    const currentLongitude = document.getElementById("longitude").value;
    const start = {lat: 56.5, lng: 21};

    if (currentLatitude && currentLongitude) {
        start.lat = parseFloat(currentLatitude);
        start.lng = parseFloat(currentLongitude);
    } else {
        document.getElementById("latitude").value = start.lat;
        document.getElementById("longitude").value = start.lng;
    }

    const map = new google.maps.Map(document.getElementById("map"), {
        center: start,
        zoom: 14,
        mapId: document.getElementById("mapId").value,
    });
    const draggableMarker = new google.maps.marker.AdvancedMarkerView({
        map,
        position: start,
        gmpDraggable: true,
        title: "This marker is draggable."
    });

    draggableMarker.addListener("dragend", (event) => {
        const position = draggableMarker.position;
        document.getElementById("latitude").value = position.lat;
        document.getElementById("longitude").value = position.lng;
    });
}

window.initMap = initMap;
