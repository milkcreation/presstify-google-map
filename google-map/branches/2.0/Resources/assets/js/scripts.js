jQuery.getScript(
    '//maps.googleapis.com/maps/api/js?key=' + tify['google-map'].apiKey,
    function (o) {
        google.maps.event.addDomListener(
            window,
            'load',
            function () {
                let o = tify['google-map'],
                    map = new google.maps.Map(document.getElementById(o.element), o.mapOptions);

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
        );
    }
);