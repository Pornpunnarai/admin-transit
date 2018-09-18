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

        function initialize() {
            var myTrip=new Array();
            var pos = new google.maps.LatLng(18.787635,98.985683);

            var myOptions = {
                zoom: 13,
                center: pos,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var map = new google.maps.Map(document.getElementById('map'), myOptions);

            map.setCenter(pos);


//FIRST POLYLINE SNAP TO ROAD

            ChileTrip1 = [
                new google.maps.LatLng(18.80931,98.95303),
                new google.maps.LatLng(18.80204,98.96684)
            ];

            // ChileTrip1 = [];
            // $.getJSON("/admin-transit/API/JSON/route/", function(jsonCM1) {
            //     $.each(jsonCM1, function(i, station1) {
            //         if(station1.type=="R1G"){
            //             // lat[count] = station1.lat;
            //             // long[count] = station1.lng;
            //
            //             ChileTrip1.push(new google.maps.LatLng(parseFloat(station1.lat),parseFloat(station1.lng)));
            //
            //         }
            //
            //     });
            // });

            // console.log(pos.lat());
            var traceChileTrip1 = new google.maps.Polyline({
                path: ChileTrip1,
                strokeColor: "red",
                strokeOpacity: 1.0,
                strokeWeight: 0
            });

var str = "";
            var service1 = new google.maps.DirectionsService(),traceChileTrip1,snap_path1=[];
            traceChileTrip1.setMap(map);
            for(j=0;j<ChileTrip1.length-1;j++){
                service1.route({origin: ChileTrip1[j],destination: ChileTrip1[j+1],travelMode: google.maps.DirectionsTravelMode.DRIVING},function(result, status) {

                    if(status == google.maps.DirectionsStatus.OK) {
                        snap_path1 = snap_path1.concat(result.routes[0].overview_path);


                        for(var i=0;i<=snap_path1.length-1;i++){

                            var latlng = {lat:snap_path1[i].lat(),lng:snap_path1[i].lng()}
                            console.log(snap_path1[i].lat(),snap_path1[i].lng());
                            myTrip.push(latlng);
                    // str += "{lat: "+snap_path1[i].lat()+", lng: "+snap_path1[i].lng()+"},";

// console.log("{lat: "+snap_path1[i].lat()+", lng: "+snap_path1[i].lng()+"}");
                            // test.push(new google.maps.LatLng(parseFloat(snap_path1[i].lat()),parseFloat(snap_path1[i].lng())));
                        }
                        for(var i=0;i<=myTrip.length-1;i++) {

                            if(myTrip[i+1]!=null){
                            var p1 = {x: myTrip[i].lat, y: myTrip[i].lng};

                            var p2 = {x: myTrip[i+1].lat, y: myTrip[i+1].lng};

                            // angle in radians
                            var angleRadians = Math.atan2(p2.y - p1.y, p2.x - p1.x);

                            // angle in degrees
                            var angleDeg = Math.atan2(p2.y - p1.y, p2.x - p1.x) * 180 / Math.PI;

                            if(angleDeg < 0){
                                angleDeg = 360 + angleDeg;
                            }

                            console.log(angleDeg);
                            }
                        }

                        var flightPath = new google.maps.Polyline({
                            path: myTrip,
                            geodesic: true,
                            strokeColor: '#0d0c55',
                            strokeOpacity: 1.0,
                            strokeWeight: 2
                        });
                        console.log(flightPath);
                        flightPath.setMap(map);
                        // console.log(str);
                        traceChileTrip1.setPath(snap_path1);
                    } else alert("Directions request failed: "+status);
                });




            }



            // var flightPlanCoordinates = [
            //     {lat: 18.80983, lng: 98.94780000000002},{lat: 18.81023, lng: 98.94795},{lat: 18.810380000000002, lng: 98.94796000000001},{lat: 18.81039, lng: 98.94800000000001},{lat: 18.81043, lng: 98.94805000000001},{lat: 18.8105, lng: 98.94808},{lat: 18.8106, lng: 98.94809000000001},{lat: 18.81071, lng: 98.94807},{lat: 18.81072, lng: 98.9484},{lat: 18.8107, lng: 98.9488},{lat: 18.810640000000003, lng: 98.94911},{lat: 18.81033, lng: 98.95017000000001},{lat: 18.810280000000002, lng: 98.95036},{lat: 18.810280000000002, lng: 98.95047000000001},{lat: 18.81012, lng: 98.95095},{lat: 18.809980000000003, lng: 98.95147000000001},{lat: 18.80986, lng: 98.95183},{lat: 18.80957, lng: 98.95246},{lat: 18.809260000000002, lng: 98.95306000000001},{lat: 18.808490000000003, lng: 98.95455000000001},{lat: 18.808120000000002, lng: 98.95531000000001},{lat: 18.80739, lng: 98.9568},{lat: 18.807080000000003, lng: 98.95741000000001},{lat: 18.8065, lng: 98.95845000000001},{lat: 18.8062, lng: 98.95902000000001},{lat: 18.8058, lng: 98.95972},{lat: 18.80555, lng: 98.96011000000001},{lat: 18.805410000000002, lng: 98.96036000000001},{lat: 18.803610000000003, lng: 98.96368000000001},{lat: 18.80291, lng: 98.96495},{lat: 18.80243, lng: 98.96595},{lat: 18.8016, lng: 98.96749000000001},{lat: 18.801530000000003, lng: 98.96763000000001},{lat: 18.801530000000003, lng: 98.96769},{lat: 18.801550000000002, lng: 98.96779000000001},{lat: 18.80159, lng: 98.96790000000001},{lat: 18.801630000000003, lng: 98.96796},{lat: 18.801920000000003, lng: 98.96809},{lat: 18.802480000000003, lng: 98.96833000000001},{lat: 18.80284, lng: 98.96853},{lat: 18.80329, lng: 98.96877},{lat: 18.80415, lng: 98.96929000000002},{lat: 18.804650000000002, lng: 98.96967000000001},{lat: 18.806140000000003, lng: 98.97087},{lat: 18.80676, lng: 98.97147000000001},{lat: 18.807360000000003, lng: 98.97216},{lat: 18.80779, lng: 98.97264000000001},{lat: 18.808400000000002, lng: 98.97341},{lat: 18.808760000000003, lng: 98.97392},{lat: 18.80918, lng: 98.97457000000001},{lat: 18.80966, lng: 98.97539},{lat: 18.810190000000002, lng: 98.97645000000001},{lat: 18.81052, lng: 98.97719000000001},{lat: 18.81097, lng: 98.97851000000001},{lat: 18.81109, lng: 98.97889},{lat: 18.811420000000002, lng: 98.98028000000001},{lat: 18.811590000000002, lng: 98.98118000000001},{lat: 18.811880000000002, lng: 98.98329000000001},{lat: 18.811960000000003, lng: 98.98386},{lat: 18.811970000000002, lng: 98.98395000000001},{lat: 18.81201, lng: 98.98431000000001},{lat: 18.812160000000002, lng: 98.98601000000001},{lat: 18.812230000000003, lng: 98.98742000000001},{lat: 18.812230000000003, lng: 98.98868},{lat: 18.8122, lng: 98.98917},{lat: 18.812050000000003, lng: 98.99051000000001},{lat: 18.811690000000002, lng: 98.99246000000001},{lat: 18.81116, lng: 98.99541},{lat: 18.81086, lng: 98.99696},{lat: 18.81052, lng: 98.99902},{lat: 18.810480000000002, lng: 98.99929},{lat: 18.81041, lng: 99.00002},{lat: 18.810200000000002, lng: 99.00269},{lat: 18.81014, lng: 99.00374000000001},{lat: 18.81012, lng: 99.00403000000001},{lat: 18.810010000000002, lng: 99.00539},{lat: 18.80996, lng: 99.00637},{lat: 18.80977, lng: 99.00911},{lat: 18.80969, lng: 99.01029000000001},{lat: 18.809600000000003, lng: 99.01098},{lat: 18.80939, lng: 99.01195000000001},{lat: 18.80927, lng: 99.01235000000001},{lat: 18.809070000000002, lng: 99.01291},{lat: 18.808690000000002, lng: 99.01377000000001},{lat: 18.808600000000002, lng: 99.01395000000001},{lat: 18.80817, lng: 99.01467000000001},{lat: 18.807930000000002, lng: 99.01505},{lat: 18.80748, lng: 99.01566000000001},{lat: 18.807260000000003, lng: 99.01593000000001},{lat: 18.806880000000003, lng: 99.01631},{lat: 18.806540000000002, lng: 99.01664000000001},{lat: 18.806050000000003, lng: 99.01705000000001},{lat: 18.805690000000002, lng: 99.01732000000001},{lat: 18.805390000000003, lng: 99.01752},{lat: 18.805000000000003, lng: 99.01777000000001},{lat: 18.80458, lng: 99.01800000000001},{lat: 18.804090000000002, lng: 99.01823},{lat: 18.80368, lng: 99.01841},{lat: 18.80149, lng: 99.01931},{lat: 18.80035, lng: 99.0198},{lat: 18.796180000000003, lng: 99.02158000000001},{lat: 18.793960000000002, lng: 99.02253},{lat: 18.793100000000003, lng: 99.02295000000001},{lat: 18.79185, lng: 99.02363000000001},{lat: 18.78931, lng: 99.02514000000001},{lat: 18.788890000000002, lng: 99.02537000000001},{lat: 18.788030000000003, lng: 99.02575},{lat: 18.78741, lng: 99.02601000000001},{lat: 18.786910000000002, lng: 99.02618000000001},{lat: 18.786420000000003, lng: 99.02632000000001},{lat: 18.78575, lng: 99.02648},{lat: 18.785040000000002, lng: 99.02661},{lat: 18.78346, lng: 99.02684},{lat: 18.7801, lng: 99.02736},{lat: 18.77963, lng: 99.02752000000001},{lat: 18.77955, lng: 99.02756000000001},{lat: 18.779130000000002, lng: 99.02763},{lat: 18.77868, lng: 99.02771000000001},{lat: 18.77381, lng: 99.02839},{lat: 18.771710000000002, lng: 99.02865000000001},{lat: 18.77024, lng: 99.02886000000001},{lat: 18.76905, lng: 99.02905000000001},{lat: 18.768800000000002, lng: 99.02909000000001},{lat: 18.76863, lng: 99.02911},{lat: 18.76858, lng: 99.0292},{lat: 18.76855, lng: 99.02922000000001},{lat: 18.76779, lng: 99.02934},{lat: 18.76769, lng: 99.02937000000001},{lat: 18.76751, lng: 99.02950000000001},{lat: 18.76704, lng: 99.03002000000001},{lat: 18.76695, lng: 99.03015},{lat: 18.766910000000003, lng: 99.03032},{lat: 18.7668, lng: 99.03081},{lat: 18.76671, lng: 99.03106000000001},{lat: 18.76661, lng: 99.03125000000001},{lat: 18.766360000000002, lng: 99.03155000000001},{lat: 18.766000000000002, lng: 99.03192000000001},{lat: 18.765800000000002, lng: 99.03216},{lat: 18.76573, lng: 99.03228000000001},{lat: 18.76566, lng: 99.03249000000001},{lat: 18.76564, lng: 99.03261},{lat: 18.76565, lng: 99.03332},{lat: 18.76565, lng: 99.03426},{lat: 18.765600000000003, lng: 99.03478000000001},{lat: 18.76548, lng: 99.03551},{lat: 18.76536, lng: 99.03591},{lat: 18.76518, lng: 99.03635000000001},{lat: 18.76557, lng: 99.0365},{lat: 18.76558, lng: 99.03663},{lat: 18.76564, lng: 99.03682},{lat: 18.765780000000003, lng: 99.03691},{lat: 18.765900000000002, lng: 99.0369}
            // ];

            // console.log(flightPlanCoordinates);
            // console.log(myTrip);

//SECOND POLYLINE SNAP TO ROAD
//
//             ChileTrip2 = [
//                 // new google.maps.LatLng(18.80983,98.94781),
//                 // new google.maps.LatLng(18.81023,98.94794),
//                 // new google.maps.LatLng(18.81038,98.94795),
//                 // new google.maps.LatLng(18.81039,98.94788),
//             ];
//
//             var traceChileTrip2 = new google.maps.Polyline({
//                 path: ChileTrip2,
//                 strokeColor: "blue",
//                 strokeOpacity: 1.0,
//                 strokeWeight: 2
//             });
//
//             var service2 = new google.maps.DirectionsService(),traceChileTrip2,snap_path2=[];
//             traceChileTrip2.setMap(map);
//             for(j=0;j<ChileTrip2.length-1;j++){
//                 service2.route({origin: ChileTrip2[j],destination: ChileTrip2[j+1],travelMode: google.maps.DirectionsTravelMode.DRIVING},function(result, status) {
//                     if(status == google.maps.DirectionsStatus.OK) {
//                         snap_path2 = snap_path2.concat(result.routes[0].overview_path);
//                         traceChileTrip2.setPath(snap_path2);
//                     } else alert("Directions2 request failed: "+status);
//                 });
//             }
//
        };
        window.onload = function() { initialize();};


    </script>

    <script>

    </script>
</head>
<body>
<div id="map" style="height: 700px; width:100%;"></div>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
    _uacct = "UA-162157-1";
    urchinTracker();
</script>
</body>
</html>
