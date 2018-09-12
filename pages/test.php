<!DOCTYPE html>
<html lang="en">

<head>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCeIm4Qr_eDTBDnE55Q1DJbZ4qXZLYjss"></script>
    <script>
        var position = {lat: 18.787635, lng: 98.985683};

        var icon = null;
        function initialize() {

            setInterval(function() {
                    $.getJSON("/admin-transit/CM_CAR/API", function(jsonBus1) {
                        $.each(jsonBus1, function(i, carB1) {
                            if(carB1.Registerid=='10-7118'){
console.log(carB1);
                                var icon_type = 'minibus';
                                const x = parseFloat(carB1.Direction);
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


                                var result = [carB1.LaGoogle, carB1.LongGoogle];
                                transition(result);

                            }
                        });
                    });
                },
                5000);



            var latlng = new google.maps.LatLng(position.lat, position.lng);
            var myOptions = {
                zoom: 16,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("mapCanvas"), myOptions);


            marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: "Latitude:"+position.lat+" | Longitude:"+position.lng,
                icon: '/admin-transit/image/icon_car/degree/minibus-10.png'
            });

            // google.maps.event.addListener(map, 'click', function(event) {
            //     var result = [event.latLng.lat(), event.latLng.lng()];
            //     transition(result);
            // });
        }

        //Load google map
        google.maps.event.addDomListener(window, 'load', initialize);


        var numDeltas = 100;
        var delay = 10; //milliseconds
        var i = 0;
        var deltaLat;
        var deltaLng;

        function transition(result){
            i = 0;
            deltaLat = (result[0] - position.lat)/numDeltas;
            deltaLng = (result[1] - position.lng)/numDeltas;

            moveMarker();
        }

        function moveMarker(){
            var lat = position.lat + deltaLat;
            var lng = position.lng + deltaLng;

            position = {lat: lat, lng: lng};

            var latlng = new google.maps.LatLng(position.lat, position.lng);
            marker.setTitle("Latitude:"+position.lat+" | Longitude:"+position.lng);
            marker.setPosition(latlng);
            marker.setIcon(icon);
            if(i!=numDeltas){
                i++;
                setTimeout(moveMarker, delay);
            }
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
