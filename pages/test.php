<!DOCTYPE html>
<html lang="en">

<head>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCeIm4Qr_eDTBDnE55Q1DJbZ4qXZLYjss"></script>
    <script>
        var car = (function () {
            var car = null;
            $.ajax({
                'async': false,
                'global': false,
                'url': "/admin-transit/CM_CAR/API",
                'dataType': "json",
                'success': function (data) {
                    car = data;
                }
            });
            return car;
        })();



        var position = {lat: 18.787635, lng: 98.985683};
        var array_result = [];
        var array_marker = [];
        var array_postion = [];
        var array_delta = [];
        var icon = null;
        function initialize() {
            var result = null;
            setInterval(function() {
                    // array_result = [];
                    var xi = 0;
                    $.getJSON("/admin-transit/CM_CAR/API", function(jsonBus1) {

                        $.each(jsonBus1, function(i, carB1) {
                            if(carB1.Type=='bus'||carB1.Type=='minibus'||carB1.Type=='kwvan'){


                            // result = {lat: carB1.LaGoogle, lng: carB1.LongGoogle};
                            // array_result.push(result);
                            array_result[xi] = {lat: parseFloat(carB1.LaGoogle), lng: parseFloat(carB1.LongGoogle)
                                , direction: parseFloat(carB1.Direction), type: carB1.Detail};
                            xi++;
                            }
                        });
                    });

                    transition(array_result);

                },
                2000);



            var latlng = new google.maps.LatLng(position.lat, position.lng);
            var myOptions = {
                zoom: 16,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("mapCanvas"), myOptions);
            info = new google.maps.InfoWindow();


            for (var i = 0; i <= car.length-1; i++) {
                if(car[i].Type=='bus'||car[i].Type=='minibus'||car[i].Type=='kwvan'){
                var positions = {lat: parseFloat(car[i].LaGoogle), lng: parseFloat(car[i].LongGoogle)};
                array_postion.push(positions);

                latlng = new google.maps.LatLng(parseFloat(car[i].LaGoogle), parseFloat(car[i].LongGoogle));
                marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    title: "Latitude:" + position.lat + " | Longitude:" + position.lng,
                    icon: check_direction(car[i].Direction,car[i].Detail)
                });

                    marker['infowindow'] = new google.maps.InfoWindow({
                        content: 'sssss'
                    });

                    google.maps.event.addListener(marker, 'click', function(marker, i) {
                        this['infowindow'].open(map, this);
                    });


                array_marker.push(marker);

                    //
                    // google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    //     return function () {
                    //         info.setContent('<div id="content">xxx</div>');
                    //         info.open(map, marker);
                    //     }
                    // })(marker, i));
                }
            }

            // google.maps.event.addListener(map, 'click', function(event) {
            //     var result = [event.latLng.lat(), event.latLng.lng()];
            //     transition(result);
            // });
        }

        //Load google map
        google.maps.event.addDomListener(window, 'load', initialize);


        var numDeltas = 100;
        var delay = 10; //milliseconds
        var x = 0;
        var deltaLat;
        var deltaLng;

        function transition(array_result){
            x = 0;
            // console.log(array_result,array_postion);
            for (var i = 0; i <= array_result.length-1; i++) {

                deltaLat = (array_result[i].lat - array_postion[i].lat) / numDeltas;
                deltaLng = (array_result[i].lng - array_postion[i].lng) / numDeltas;
                array_delta[i] = {lat: deltaLat, lng: deltaLng};

            }

            moveMarker();
        }

        function moveMarker(){

            for (var i = 0; i <= array_delta.length-1; i++) {
                // console.log(i);
                var lat = array_postion[i].lat + array_delta[i].lat;
                var lng = array_postion[i].lng + array_delta[i].lng;

                array_postion[i] = {lat: lat, lng: lng};

                var latlng = new google.maps.LatLng(array_postion[i].lat, array_postion[i].lng);
                array_marker[i].setTitle("Latitude:" + array_postion[i].lat + " | Longitude:" + array_postion[i].lng);
                array_marker[i].setPosition(latlng);
                array_marker[i].setIcon(check_direction(array_result[i].direction,array_result[i].type));

                var marker = array_marker[i];
                // google.maps.event.addListener(marker, 'click', (function (marker, i) {
                //     return function () {
                //         info.setContent('ssss'+array_postion[i].lng);
                //     }
                // })(marker, i));

                marker['infowindow'] = new google.maps.InfoWindow({
                    content: 'sssss'+array_postion[i].lng
                });

            }
            if(x!=numDeltas){
                x++;
                setTimeout(moveMarker, delay);
            }
        }


        function check_direction(direction,type) {
            var icon_type = 'minibus';

            if(type=="R1"){
                icon_type = "R1G";
            }
            if(type=="R2"||type=="สำรอง"){
                icon_type = "R2P";
            }
            if(type=="R3-Y"){
                icon_type = "R3Y";
            }
            if(type=="R3-R"){
                icon_type = "R3R";
            }

            if(type=="B1,2"||type=="B1,6"||type=="B1,3" ||type=="B1,1"
                ||type=="B1,5"||type=="B1,4")
            {
                icon_type = "minibus";
            }
            if(type=="B2,5"||type=="B2,1"|| type=="B2,4"
                ||type=="B2,6"||type=="B2,2"||type=="B2,3")
            {
                icon_type = "minibus";
            }
            if(type=="B3,30"||type=="B3,33"||type=="B3,34"||type=="B3,37")
            {
                icon_type = "minibus";
            }


            if(type=="")
            {
                icon_type = "KWG";
            }

            const x = parseFloat(direction);
            switch (true) {
                case (x >= 5 && x <= 15):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-10.png';
                    break;
                case (x >= 15 && x <= 25):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-20.png';
                    break;
                case (x >= 25 && x <= 35):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-30.png';
                    break;
                case (x >= 35 && x <= 45):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-40.png';
                    break;
                case (x >= 45 && x <= 55):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-50.png';
                    break;
                case (x >= 55 && x <= 65):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-60.png';
                    break;
                case (x >= 65 && x <= 75):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-70.png';
                    break;
                case (x >= 75 && x <= 85):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-80.png';
                    break;
                case (x >= 85 && x <= 95):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-90.png';
                    break;
                case (x >= 95 && x <= 105):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-100.png';
                    break;
                case (x >= 105 && x <= 115):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-110.png';
                    break;
                case (x >= 115 && x <= 125):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-120.png';
                    break;
                case (x >= 125 && x <= 135):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-130.png';
                    break;
                case (x >= 135 && x <= 145):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-140.png';
                    break;
                case (x >= 145 && x <= 155):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-150.png';
                    break;
                case (x >= 155 && x <= 165):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-160.png';
                    break;
                case (x >= 165 && x <= 175):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-170.png';
                    break;
                case (x >= 175 && x <= 185):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-180.png';
                    break;
                case (x >= 185 && x <= 195):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-190.png';
                    break;
                case (x >= 195 && x <= 205):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-200.png';
                    break;
                case (x >= 205 && x <= 215):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-210.png';
                    break;
                case (x >= 215 && x <= 225):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-220.png';
                    break;
                case (x >= 225 && x <= 235):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-230.png';
                    break;
                case (x >= 235 && x <= 245):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-240.png';
                    break;
                case (x >= 245 && x <= 255):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-250.png';
                    break;
                case (x >= 255 && x <= 265):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-260.png';
                    break;
                case (x >= 265 && x <= 275):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-270.png';
                    break;
                case (x >= 275 && x <= 285):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-280.png';
                    break;
                case (x >= 285 && x <= 295):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-290.png';
                    break;
                case (x >= 295 && x <= 305):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-300.png';
                    break;
                case (x >= 305 && x <= 315):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-310.png';
                    break;
                case (x >= 315 && x <= 325):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-320.png';
                    break;
                case (x >= 325 && x <= 335):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-330.png';
                    break;
                case (x >= 335 && x <= 345):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-340.png';
                    break;
                case (x >= 345 && x <= 355):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-350.png';
                    break;
                case (x >= 355 && x <= 360):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-360.png';
                    break;
                case (x >= 0 && x <= 5):
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-360.png';
                    break;
                default:
                    icon = '/admin-transit/image/icon_car/degree/'+icon_type+'-360.png';
                    break;
            }
            return icon;
        }
    </script>
    <style>
        #mapCanvas{
            width: 100%;
            height: 400px;
        }
    </style>
</head>

<body>
<div id="mapCanvas"></div>
</body>

</html>
