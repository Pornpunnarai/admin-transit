<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Google Maps JavaScript API v3 Example: Directions Waypoints</title>
    <style>
        #map{
            width: 100%;
            height: 450px;
        }
    </style>
    <!--    <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <!--    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCeIm4Qr_eDTBDnE55Q1DJbZ4qXZLYjss"></script>-->

    <script>
        var locations = [
            {
                "id": "1",
                "name": "Location 1",
                "lat": "53.408371",
                "lng": "-2.991573",
                "rating": "17"
            },
            {
                "id": "2",
                "name": "Location 2",
                "lat": "53.789528",
                "lng": "-2.969411",
                "rating": "8"
            },
        ]

        var map;
        var geocoder;
        var infowindow;
        var rating;
        var markers = [];

        function initMap() {
            var mapElement = document.getElementById("map_canvas");

            geocoder = new google.maps.Geocoder();

            var mapOptions = {
                center: new google.maps.LatLng(53.481949, -2.237430),
                zoom: 7,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            infowindow = new google.maps.InfoWindow();

            map = new google.maps.Map(mapElement, mapOptions);
        }

        $(document).on('click', '#been-there', function(event){
            var entryID = $(this).data('entry-id');
            var dataString = 'id='+ entryID;

            rating = markers[entryID].rating;
            rating++;

            markers[entryID].rating = rating;

            $('#rating').html("ssss"+rating);

        });

        $.each(locations, function(key, data) {

            var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + data.lat + "," + data.lng + "&result_type=sublocality|political&key=AIzaSyCsY-LOPL7dGbA1ShBEu7zMO8_GaSBA3Vg";

            $.getJSON(url, function(reverseGeo) {
                var postal_town = reverseGeo.results[0].formatted_address;

                geocoder.geocode( { 'address': postal_town}, function(results, status) {
                    if (status == 'OK') {

                        var marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location,
                            title: data.name,
                            rating: data.rating
                        });

                        markers[data.id] = marker;

                        console.log(markers[data.id].rating);

                        var contentString = '<div id="content">'+
                            '<h1>' + data.name + '</h1>' +
                            '<button id="been-there" data-rating="' + data.rating + '" data-entry-id="' + data.id + '">Been There</button>' +
                            '<p><strong>Rating: </strong><span id="rating">' + markers[data.id].rating + '</span></p>' +
                            '</div>';

                        marker.addListener('click', function() {
                            infowindow.setContent(contentString);
                            infowindow.open(map, marker);
                        });

                    } else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }
                });
            });
        });
    </script>
</head>
<body>
<div id="map_canvas" style="height: 700px; width:100%;"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsY-LOPL7dGbA1ShBEu7zMO8_GaSBA3Vg&callback=initMap"> </script>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
    _uacct = "UA-162157-1";
    urchinTracker();
</script>
</body>
</html>
