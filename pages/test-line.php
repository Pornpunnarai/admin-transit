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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCeIm4Qr_eDTBDnE55Q1DJbZ4qXZLYjss"></script>
    <script>
        var json_station = (function () {
            var station = null;
            $.ajax({
                'async': false,
                'global': false,
                'url': "/admin-transit/API/JSON/station/",
                'dataType': "json",
                'success': function (data) {
                    station = data;
                }
            });
            return station;
        })();

        var array_selected = [];

        var xi = 0;
        for(var i = 0;i<=json_station.length-1;i++) {
            if (json_station[i].type == "R1G") {

                // console.log(json_station[i]);
                array_selected[xi] = json_station[i];
                xi++;
            }
        }
        console.log(array_selected);
        var pos = new google.maps.LatLng(18.787635,98.985683);
        var myOptions = {
            zoom: 13,
            center: pos,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map;
        var stations = [];
        var points = [];
        var flightPaths = [];
        function initialize() {

            map = new google.maps.Map(document.getElementById('map'), myOptions);
            map.setCenter(pos);


        };
        window.onload = function() { initialize();};










        var count = 0;
        var BS_special = '/admin-transit/image/icon_station/point.png';
        var myTrip=new Array();
        var new_mytrip = [];
        var old_mytrip = [];


var station_table = [];
        var route_table = [];
        var route_cal = [];

        function drawLine() {

             if(count!=0){
//i start 1
if(count==1) {
    //For first time

    var station ={station_id:array_selected[count-1].id,point_lat: new_mytrip[0].lat,point_lng: new_mytrip[0].lng};

    station_table.push(station);

    station ={station_id:array_selected[count].id,point_lat: new_mytrip[new_mytrip.length - 1].lat,point_lng: new_mytrip[new_mytrip.length - 1].lng};

    station_table.push(station);
    var x = 1;
        for (var i = 0; i <= new_mytrip.length - 1; i++) {

        old_mytrip.push({lat: new_mytrip[i].lat, lng: new_mytrip[i].lng});

        route_table.push({lat: new_mytrip[i].lat, lng: new_mytrip[i].lng,
            station_start: array_selected[count-1].id, station_end: array_selected[count].id, type: array_selected[count].type});

        if(new_mytrip[i+1]!=null){

            if(new_mytrip[i+1]!=null){
                var p1 = {x: new_mytrip[i].lat, y: new_mytrip[i].lng};
                var p2 = {x: new_mytrip[i+1].lat, y: new_mytrip[i+1].lng};
                // angle in radians
                var angleRadians = Math.atan2(p2.y - p1.y, p2.x - p1.x);
                // angle in degrees
                var angleDeg = Math.atan2(p2.y - p1.y, p2.x - p1.x) * 180 / Math.PI;
                if(angleDeg < 0){
                    angleDeg = 360 + angleDeg;
                }
            }


        route_cal.push({route_id: 1,route_type:array_selected[count].type,	station_id_start:array_selected[count-1].id,
            station_name_start:	array_selected[count-1].station_name,station_id_dest:array_selected[count].id,station_name_dest:array_selected[count].station_name,
            section_start:x,section_end:x+1,section_all:new_mytrip.length - 1,lat_start:new_mytrip[i].lat,lng_start:new_mytrip[i].lng,lat_dest:new_mytrip[i+1].lat,lng_dest:new_mytrip[i+1].lng,
            direction: angleDeg
        });
x++;
        }

    }

}
else {

    station ={station_id:array_selected[count].id,point_lat: new_mytrip[new_mytrip.length - 1].lat,point_lng: new_mytrip[new_mytrip.length - 1].lng};

    station_table.push(station);
    var x = 1;
    for (var i = 1; i <= new_mytrip.length - 1; i++) {

        old_mytrip.push({lat: new_mytrip[i].lat, lng: new_mytrip[i].lng});

        route_table.push({lat: new_mytrip[i].lat, lng: new_mytrip[i].lng,
            station_start: array_selected[count-1].id, station_end: array_selected[count].id, type: array_selected[count].type});


    }
    //fix special bug
    for (var i = 0; i <= new_mytrip.length - 1; i++) {
        if (new_mytrip[i + 1] != null) {

            if (new_mytrip[i + 1] != null) {
                var p1 = {x: new_mytrip[i].lat, y: new_mytrip[i].lng};
                var p2 = {x: new_mytrip[i + 1].lat, y: new_mytrip[i + 1].lng};
                // angle in radians
                var angleRadians = Math.atan2(p2.y - p1.y, p2.x - p1.x);
                // angle in degrees
                var angleDeg = Math.atan2(p2.y - p1.y, p2.x - p1.x) * 180 / Math.PI;
                if (angleDeg < 0) {
                    angleDeg = 360 + angleDeg;
                }
            }


            route_cal.push({
                route_id: 1,
                route_type: array_selected[count].type,
                station_id_start: array_selected[count - 1].id,
                station_name_start: array_selected[count - 1].station_name,
                station_id_dest: array_selected[count].id,
                station_name_dest: array_selected[count].station_name,
                section_start: x,
                section_end: x + 1,
                section_all: new_mytrip.length - 1,
                lat_start: new_mytrip[i].lat,
                lng_start: new_mytrip[i].lng,
                lat_dest: new_mytrip[i + 1].lat,
                lng_dest: new_mytrip[i + 1].lng,
                direction: angleDeg
            });
            x++;
        }

    }
}

                 // for(var i=0;i<=new_mytrip.length-1;i++) {
                 //     if(new_mytrip[i+1]!=null){
                 //         var p1 = {x: new_mytrip[i].lat, y: new_mytrip[i].lng};
                 //         var p2 = {x: new_mytrip[i+1].lat, y: new_mytrip[i+1].lng};
                 //         // angle in radians
                 //         var angleRadians = Math.atan2(p2.y - p1.y, p2.x - p1.x);
                 //         // angle in degrees
                 //         var angleDeg = Math.atan2(p2.y - p1.y, p2.x - p1.x) * 180 / Math.PI;
                 //         if(angleDeg < 0){
                 //             angleDeg = 360 + angleDeg;
                 //         }
                 //         console.log(angleDeg,i);
                 //     }
                 // }

                 new_mytrip = [];

             }

    if(array_selected[count+1]!=null){
        clearPoint();
        clearStation();
        clearPolyline();



    ChileTrip1 = [
        new google.maps.LatLng(array_selected[count].station_lat,array_selected[count].station_lng),
        new google.maps.LatLng(array_selected[count+1].station_lat,array_selected[count+1].station_lng)
    ];
map.setCenter(new google.maps.LatLng(array_selected[count+1].station_lat,array_selected[count+1].station_lng));
map.setZoom(17);


        var marker1 = new google.maps.Marker({
            position: new google.maps.LatLng(array_selected[count].station_lat, array_selected[count].station_lng),
            map: map,
            title: array_selected[count].station_name,
            icon: '/admin-transit/image/icon_station/R3R_busstop.png'
        });
        google.maps.event.addListener(marker1, 'click', (function(marker1, i) {
            return function() {
                info.setContent('station<br>'+array_selected[count].station_lat+","+array_selected[count].station_lng);

                info.open(map, marker1);
            }
        })(marker1, i));
        stations.push(marker1);
        var marker2 = new google.maps.Marker({
            position: new google.maps.LatLng(array_selected[count+1].station_lat, array_selected[count+1].station_lng),
            map: map,
            title: array_selected[count+1].station_name,
            icon: '/admin-transit/image/icon_station/R3R_busstop.png'
        });
        google.maps.event.addListener(marker2, 'click', (function(marker2, i) {
            return function() {
                info.setContent('station<br>'+array_selected[count].station_lat+","+array_selected[count].station_lng);

                info.open(map, marker2);
            }
        })(marker2, i));
        stations.push(marker2);




        count++;
    var traceChileTrip1 = new google.maps.Polyline({
        path: ChileTrip1,
        strokeColor: "red",
        strokeOpacity: 1.0,
        strokeWeight: 0
    });




    var service1 = new google.maps.DirectionsService(),traceChileTrip1,snap_path1=[];
    traceChileTrip1.setMap(map);
    for(j=0;j<ChileTrip1.length-1;j++){
        service1.route({origin: ChileTrip1[j],destination: ChileTrip1[j+1],travelMode: google.maps.DirectionsTravelMode.DRIVING},function(result, status) {
            if(status == google.maps.DirectionsStatus.OK) {
                snap_path1 = snap_path1.concat(result.routes[0].overview_path);
                for(var i=0;i<=snap_path1.length-1;i++){
                    var latlng = {lat:snap_path1[i].lat(),lng:snap_path1[i].lng()}
                    // console.log(snap_path1[i].lat(),snap_path1[i].lng());
                    var marker3 = new google.maps.Marker({
                        position: new google.maps.LatLng(snap_path1[i].lat(),snap_path1[i].lng()),
                        map: map,
                        title: snap_path1[i].lat()+","+snap_path1[i].lng(),
                        icon: BS_special
                    });
                    info = new google.maps.InfoWindow();
                    google.maps.event.addListener(marker3, 'click', (function(marker3, i) {
                        return function() {
                            // info.setContent('point<br>'+snap_path1[i].lat()+","+snap_path1[i].lng());
                            //
                            // info.open(map, marker3);
                        }
                    })(marker3, i));
                    // console.log(i);
                    info.setContent(''+i);
                    info.open(map, marker3);
                    points.push(marker3);
                    new_mytrip.push(latlng);
                }




                var flightPath2 = new google.maps.Polyline({
                    path: old_mytrip,
                    geodesic: true,
                    strokeColor: '#ff1835',
                    strokeOpacity: 1.0,
                    strokeWeight: 2
                });
                flightPath2.setMap(map);
                flightPaths.push(flightPath2);

                var flightPath = new google.maps.Polyline({
                    path: new_mytrip,
                    geodesic: true,
                    strokeColor: '#0d0c55',
                    strokeOpacity: 1.0,
                    strokeWeight: 2
                });


                flightPaths.push(flightPath);
                flightPath.setMap(map);


                // myTrip = [];
                traceChileTrip1.setPath(snap_path1);
            } else {
                alert("Directions request failed: "+status);
                location.reload();
            }

        });
    }
    }else {
        clearPoint();
        clearStation();
        clearPolyline();
console.log(station_table);
console.log(route_table);
        console.log(route_cal);
        // console.log(old_mytrip);

        var flightPath = new google.maps.Polyline({
            path: old_mytrip,
            geodesic: true,
            strokeColor: '#0d0c55',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });


        flightPaths.push(flightPath);
        flightPath.setMap(map);

    }


}

        function clearStation() {
            for (var i = 0; i < stations.length; i++) {
                stations[i].setMap(null);
            }
        }

        function clearPoint() {

            for (var i = 0; i < points.length; i++) {
                points[i].setMap(null);
            }
            points = [];

        }
        function clearPolyline() {
            for (var i = 0; i < flightPaths.length; i++) {
                flightPaths[i].setMap(null);
            }
        }



        function editLine() {

            var start = parseInt(document.getElementById("start").value);
            var end = parseInt(document.getElementById("end").value);
            clearPoint();
            // clearStation();
            clearPolyline();

            if(document.getElementById("end").value!=0){
                new_mytrip.splice(start,end-start+1);
            }
            else {
                new_mytrip.splice(start,1);
            }


            // for (var i = 0; i < new_mytrip.length; i++) {
            //
            //     var marker3 = new google.maps.Marker({
            //         position: new google.maps.LatLng(new_mytrip[i].lat,new_mytrip[i].lng),
            //         map: map,
            //         title: new_mytrip[i].lat+","+new_mytrip[i].lng,
            //         icon: BS_special
            //     });
            //     info = new google.maps.InfoWindow();
            //     google.maps.event.addListener(marker3, 'click', (function(marker3, i) {
            //         return function() {
            //             // info.setContent('point<br>'+snap_path1[i].lat()+","+snap_path1[i].lng());
            //             //
            //             // info.open(map, marker3);
            //         }
            //     })(marker3, i));
            //     console.log(i);
            //     info.setContent(''+i);
            //     info.open(map, marker3);
            //
            // }
            // points.push(marker3);






            var flightPath2 = new google.maps.Polyline({
                path: old_mytrip,
                geodesic: true,
                strokeColor: '#ff1835',
                strokeOpacity: 1.0,
                strokeWeight: 2
            });
            flightPath2.setMap(map);
            flightPaths.push(flightPath2);

            var flightPath = new google.maps.Polyline({
                path: new_mytrip,
                geodesic: true,
                strokeColor: '#0d0c55',
                strokeOpacity: 1.0,
                strokeWeight: 2
            });
            // console.log(old_mytrip);
            // console.log(new_mytrip);


            flightPaths.push(flightPath);
            flightPath.setMap(map);


            // myTrip = new_mytrip;

            // for (var i = 0; i < new_mytrip.length; i++) {
            //     var latlng = {lat:new_mytrip[i].lat,lng:new_mytrip[i].lng}
            //     myTrip.push(latlng);
            // }

        }
    </script>

</head>
<body>

<div id="map" style="height: 700px; width:80%;"></div>
Array Start: <input type="number" id="start">
Array End: <input type="number" id="end" >
<button onclick="editLine()">Click</button>
<br>
<button onclick="drawLine()">Draw Line</button>

<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">

    _uacct = "UA-162157-1";
    urchinTracker();
</script>
</body>
</html>