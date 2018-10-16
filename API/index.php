<?php
//$url = 'http://183.90.168.61/cmcar/';
//$data = file_get_contents($url);
//$characters = json_decode($data);
//
//
//$new_array = array();
//
//foreach ($characters as $character) {
//    if($character->Type=="minibus"||$character->Type=="bus"||$character->Type=="kwvan"){
//        $character->datetime_busstop = 99999;
//        array_push($new_array,$character);
//    }
//
//}
////var_dump($new_array);
//
//echo json_encode($new_array);
?>
<body id="json"></body>

<script src="../vendor/jquery/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCeIm4Qr_eDTBDnE55Q1DJbZ4qXZLYjss&libraries=drawing,geometry"></script>

<script>
    var array_polygon = [];
    var json_route_point = (function () {
        var json_route_point = null;
        $.ajax({
            'async': false,
            'global': false,
            'url': "/admin-transit/API/JSON/route_calculate/",
            'dataType': "json",
            'success': function (data) {
                json_route_point = data;
            }
        });
        return json_route_point;
    })();

    var json_car = (function () {
        var json_car = null;
        $.ajax({
            'async': false,
            'global': false,
            'url': "/admin-transit/CM_CAR/API",
            'dataType': "json",
            'success': function (data) {
                json_car = data;
            }
        });
        return json_car;
    })();


    for (var i = 0; i <= json_route_point.length-1; i++) {
        var point_a = new google.maps.LatLng(json_route_point[i].lat_start, json_route_point[i].lng_start);
        var point_b = new google.maps.LatLng(json_route_point[i].lat_dest, json_route_point[i].lng_dest);
        var lineWidth = 10; // (meters)
        var lineHeading = google.maps.geometry.spherical.computeHeading(point_a, point_b);
        var p0a = google.maps.geometry.spherical.computeOffset(point_a, lineWidth, lineHeading + 90);
        var p0b = google.maps.geometry.spherical.computeOffset(point_a, lineWidth, lineHeading - 90);
        var p1a = google.maps.geometry.spherical.computeOffset(point_b, lineWidth, lineHeading + 90);
        var p1b = google.maps.geometry.spherical.computeOffset(point_b, lineWidth, lineHeading - 90);


        // how to convert above someLine into?:
        var airway = new google.maps.Polygon({
            paths: [p0a, p0b, p1b, p1a],
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 1,
            fillOpacity: 0.35,
            geodesic: true
        });

        array_polygon.push({polygon: airway,route: json_route_point[i]});

    }
    //
    // var route = array_polygon[0].route;
    // console.log(route.route_type);

        for (var i = 0; i <= json_car.length-1; i++) {
            json_car[i].Detail = convert_car_detail(json_car[i].Detail);
            for (var x = 0; x <= array_polygon.length-1; x++) {
                // array_polygon[x].route.route_type==json_car[i].Detail

                if(json_car[i].Detail == "R3R"){


                if(array_polygon[x].route.route_type == "R3R"){

                if (google.maps.geometry.poly.containsLocation(new google.maps.LatLng(json_car[i].LaGoogle, json_car[i].LongGoogle), array_polygon[x].polygon)) {
                    json_car[i].busstop = array_polygon[x].route.station_name_dest;

                }

                }
                }
            }

        }

    var str = "";

    var new_array= [];
    for (var i = 0; i <= json_car.length-1; i++) {

        if(json_car[i].Detail == "R3R"){
            str += json_car[i].Registerid+"->"+json_car[i].busstop+"<br>";
            new_array.push(json_car[i])
        }
    }



// str = JSON.stringify(new_array);



    document.getElementById("json").innerHTML = str;
        // console.log()

    function convert_car_detail(Detail) {
        var car_type = '';
        if(Detail=="R1"){
            car_type = "R1G";
        }
        if(Detail=="R2"){
            car_type = "R2B";
        }
        if(Detail=="R3-Y"||Detail=="สำรอง"){
            car_type = "R3Y";
        }
        if(Detail=="R3-R"){
            car_type = "R3R";
        }

        if(Detail=="B1,2"||Detail=="B1,6"||Detail=="B1,3" ||Detail=="B1,1"
            ||Detail=="B1,5"||Detail=="B1,4")
        {
            car_type = "B1G";
        }
        if(Detail=="B2,5"||Detail=="B2,1"|| Detail=="B2,4"
            ||Detail=="B2,6"||Detail=="B2,2"||Detail=="B2,3")
        {
            car_type = "B2G";
        }
        if(Detail=="B3,30"||Detail=="B3,33"||Detail=="B3,34"||Detail=="B3,37")
        {
            car_type = "B3G";
        }
        if(Detail=="")
        {
            car_type = "KWG";
        }

        return car_type;
    }
</script>


