google.maps.event.addDomListener(window, 'load', initMap);

function initMap() {
    o = JSON.parse(decodeURIComponent(tify.gmap));

    let map = new google.maps.Map(document.getElementById(o.element), o.mapOptions);

    o.markerOptions.map = map;

    if (o.geocode) {
        geocoder = new google.maps.Geocoder();

        geocoder.geocode(o.geocode, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                o.markerOptions.position = results[0].geometry.location
                let marker = new google.maps.Marker(o.markerOptions);
            }
        });
    } else {
        let marker = new google.maps.Marker(o.markerOptions);
    }

    google.maps.event.addDomListener(window, "resize", function () {
        google.maps.event.trigger(map, "resize");
        map.setCenter(map.getCenter());
    });
}