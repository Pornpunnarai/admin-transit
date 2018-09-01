<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CM - Transit</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>

    <div id="wrapper">

        <?php include 'navbar2.php' ?>

        <div id="page-wrapper">

            <!-- Page Content -->
            <div class="container-fluid">
                <ol class="breadcrumb" style="margin-top: 1rem;">
                    <li class="breadcrumb-item active">Route & Timetable</li>
                </ol>

                <div class="col-md-12" style="background-color: white; text-align: center">
                    <h4><br>
                        <b>รถเทศบาลนครเชียงใหม่</b><br><br>
                        <img src="/admin-transit/image/route/minibus.jpg" width="70%">
                    </h4>

                    <br>
                        <hr style="    border-top: 3px solid black;">
                    <br>

                    <h4>
                        <b>รถบัส RTC</b><br><br>
                        <img src="/admin-transit/image/route/rtc.jpg" width="100%">
                    </h4>

                    <br>
                        <hr style="    border-top: 3px solid black;">
                    <br>

                    <h4>
                        <b>รถขวัญเวียงขนส่ง จำกัด (ปอ.10)</b><br><br>
                        <img src="/admin-transit/image/route/kwanviang.jpg" width="70%">
                    </h4>

                    <br>
                    <br>
                </div>
            </div>


        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>


    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

    <script>
        var map;
        var flightAllPath = [];
        var flightPath;
        var info;
        var line = null;
        var markers = [];
        var carMark = [];
        var sB1 = 'image/icon_station/b1_beenhere.png';
        var sB2 = 'image/icon_station/b2_beenhere.png';
        var changeStation = document.getElementById("btnStaion");
        var changeCar = document.getElementById("btnCar");
        var car_symbol = "M17.402,0H5.643C2.526,0,0,3.467,0,6.584v34.804c0,3.116,2.526,5.644,5.643,5.644h11.759c3.116,0," +
            "5.644-2.527,5.644-5.644 V6.584C23.044,3.467,20.518,0,17.402,0z M22.057,14.188v11.665l-2.729," +
            "0.351v-4.806L22.057,14.188z M20.625,10.773 c-1.016,3.9-2.219,8.51-2.219,8.51H4.638l-2.222-8.51C2.417," +
            "10.773,11.3,7.755,20.625,10.773z M3.748,21.713v4.492l-2.73-0.349 V14.502L3.748,21.713z M1.018," +
            "37.938V27.579l2.73,0.343v8.196L1.018,37.938z M2.575,40.882l2.218-3.336h13.771l2.219,3.336H2.575z M19.328," +
            "35.805v-7.872l2.729-0.355v10.048L19.328,35.805z";

        function initMap() {
            car = "all";
            var location = {
                lat: 18.787635,
                lng: 98.985683
            };
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                center: location
            });

            $.getJSON("/admin-transit/CM_CAR/API", function(jsonBus1) {
                $.each(jsonBus1, function(i, carB1) {

                    if(carB1.Type == "minibus") {
                        var color = "#0d0c55";
                    }
                    if(carB1.Type == "redcar") {
                        var color = "#bb110a";
                    }
                    if(carB1.Type == "tuktuk") {
                        var color = "#055500";
                    }
                    if(carB1.Type == "bus") {
                        if(carB1.Color=="เขียว"){
                            var color = "#055500";
                        }
                        if(carB1.Color=="เหลือง"){
                            var color = '#ffff07';
                        }
                        if(carB1.Color=="แดง"){
                            var color = '#fe0404';
                        }
                        if(carB1.Color=="น้ำเงิน"){
                            var color = "#515aee";
                        }
                    }

                    //var car_detail =carB1.Detail;
                    //var array = car_detail.split(',');
                    //if(array[0]=="R3"){
                    if(carB1.Type == "bus"||carB1.Type=="minibus"||carB1.Type=="kwvan"){
                        var markBusB1 = new google.maps.Marker({
                            position: new google.maps.LatLng(carB1.LaGoogle, carB1.LongGoogle),
                            map: map,
                            title: carB1.Registerid,
                            icon: {
                               // path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
		path: car_symbol,
                                //scale: 5,
		scale: .7,
                                strokeColor: 'white',
                                strokeWeight: .01,
                                fillOpacity: 1,
                                fillColor: color,
                                // offset: '5%',
                                rotation: parseFloat(carB1.Direction)

                                // anchor: new google.maps.Point(10, 25)
                            }
                        });


                        carMark.push(markBusB1);
                        info = new google.maps.InfoWindow();

                        google.maps.event.addListener(markBusB1, 'click', (function(markBusB1, i) {
                            return function() {
                                getInfo(carB1);
                                info.open(map, markBusB1);
                            }
                        })(markBusB1, i));
                    }

                });
            });


            addAll_Path();



        }

        var json = (function () {
            var json = null;
            $.ajax({
                'async': false,
                'global': false,
                'url': "/admin-transit/API/JSON/station/",
                'dataType': "json",
                'success': function (data) {
                    json = data;
                }
            });
            return json;
        })();

        var json_route = (function () {
            var json_route = null;
            $.ajax({
                'async': false,
                'global': false,
                'url': "/admin-transit/API/JSON/route_name/",
                'dataType': "json",
                'success': function (data) {
                    json_route = data;
                }
            });
            return json_route;
        })();
        function check_obj(station_name) {
            var array = [];
            var type;

            for (var i = 0; i <= json.length-1; i++) {

                if(json[i].station_name == station_name){

                    array.push(json[i].type);
                }
            }
            type = array.join("-");
            return type;
        }

      function route(route){
                removeLine();
                clearMarkers();
                markers = [];
                addR1_Back(route);
          setMapOnCar(null);
          car = route;
          getCarlocation();
        }

        function addR1_Back(route) {

            var myTrip=new Array();
            var lat = new Array();
            var long = new Array();
            var check = null;
            var count = 0;
            console.log(line);
            if(line!=null){
                console.log("right");
                line.remove();
            }



            //line color
            var route_color;
            for (var i = 0; i <= json_route.length-1; i++) {

                if (route==json_route[i].route_code) {
                    route_color = json_route[i].routh_color;
                }
            }


            station(route);

            // $.getJSON("/admin-transit/API/JSON/station/", function(jsonCM1) {
            //
            //     $.each(jsonCM1, function(i, station1) {
            //         if(station1.type==route){
            //             console.log((check_obj(station1.station_name)),station1.station_name);
            //             if(check_obj(station1.station_name)=="R1P-R3Y"){
            //                 var icon = Purple_Yellow;
            //
            //             }
            //             else if(check_obj(station1.station_name)=="R1P-R3R"){
            //                 var icon = Red_Purple;
            //             }
            //             else if(check_obj(station1.station_name)=="R1P-R3R-R3Y"){
            //                 var icon =  Red_Purple_Yellow;
            //             }
            //             else if(check_obj(station1.station_name)=="R1P"){
            //                 var icon = BS_R1P;
            //             }
            //             else if(check_obj(station1.station_name)=="R1G-R3R"){
            //                 var icon = Red_Green;
            //             }
            //             else if(check_obj(station1.station_name)=="R1G"){
            //                 var icon = BS_R1G;
            //             }
            //             else if(check_obj(station1.station_name)=="R1P-R3Y"){
            //                 var icon = Purple_Yellow;
            //             }
            //             else if(check_obj(station1.station_name)=="R3Y"){
            //                 var icon = BS_R3Y;
            //             }else if(check_obj(station1.station_name)=="R3R"){
            //                 var icon = BS_R3R;
            //             }
            //             else if(check_obj(station1.station_name)=="R2P"){
            //                 var icon = BS_R2P;
            //             }
            //             else if(check_obj(station1.station_name)=="R2B"){
            //                 var icon = BS_R2B;
            //             }
            //             else if(check_obj(station1.station_name)=="R3R-R3Y"){
            //                 var icon = Yellow_Red;
            //             }
            //             else if(check_obj(station1.station_name)=="B1G"){
            //                 var icon = BS_B1G;
            //             }
            //             else if(check_obj(station1.station_name)=="B1B"){
            //                 var icon = BS_B1B;
            //             }
            //             else if(check_obj(station1.station_name)=="B2G"){
            //                 var icon = BS_B2G;
            //             }
            //             else if(check_obj(station1.station_name)=="B2B"){
            //                 var icon = BS_B2B;
            //             }
            //             else if(check_obj(station1.station_name)=="B3G"){
            //                 var icon = BS_B3G;
            //             }
            //             else if(check_obj(station1.station_name)=="B3B"){
            //                 var icon = BS_B3B;
            //             }
            //             else if(check_obj(station1.station_name)=="KWG"){
            //                 var icon = BS_KWG;
            //             }else {
            //                 var icon = BS_special;
            //             }
            //
            //
            //
            //
            //             var marker1 = new google.maps.Marker({
            //                 position: new google.maps.LatLng(station1.station_lat, station1.station_lng),
            //                 map: map,
            //                 title: station1.station_name,
            //                 icon: icon
            //             });
            //
            //             markers.push(marker1);
            //             info = new google.maps.InfoWindow();
            //             google.maps.event.addListener(marker1, 'click', (function(marker1, i) {
            //                 return function() {
            //                     info.setContent(station1.station_name);
            //                     info.open(map, marker1);
            //                 }
            //             })(marker1, i));
            //         }
            //     });
            // });

            $.getJSON("/admin-transit/API/JSON/route/", function(jsonCM1) {
                $.each(jsonCM1, function(i, station1) {
                    if(station1.type==route){
                        lat[count] = station1.lat;
                        long[count] = station1.lng;

                        if(lat[count]!=null){
                            myTrip.push(new google.maps.LatLng(parseFloat(lat[count]),parseFloat(long[count])));
                            count++;

                        }

                    }

                });


                flightPath = new google.maps.Polyline({
                    path: myTrip,
                    strokeColor: route_color,
                    strokeOpacity: 1.0,
                    strokeWeight: strokeWeight
                });

                addLine();


            });
        }


        $('#stationALL').click(function() {
            removeLine();
            clearMarkers();
            markers = [];
            addAll_Path();
        });
        $('#stationClear').click(function() {
            setMapOnCar(null);
            clearMarkers();
            removeLine();
            markers = [];
        });






        var BS_R1G = '/admin-transit/image/icon_station/R1G_busstop.png';
        var BS_R1P = '/admin-transit/image/icon_station/R1P_busstop.png';
        var BS_R2P = '/admin-transit/image/icon_station/R2P_busstop.png';
        var BS_R2B = '/admin-transit/image/icon_station/R2B_busstop.png';
        var BS_R3Y = '/admin-transit/image/icon_station/R3Y_busstop.png';
        var BS_R3R = '/admin-transit/image/icon_station/R3R_busstop.png';
        var Pink_Brown = '/admin-transit/image/icon_station/red-green.png';
        var Purple_Yellow = '/admin-transit/image/icon_station/purple-yellow.png';
        var Yellow_Red = '/admin-transit/image/icon_station/yellow-red.png';
        var Red_Green = '/admin-transit/image/icon_station/red-green.png';
        var Red_Purple = '/admin-transit/image/icon_station/red-purple.png';
        var Red_Purple_Yellow = '/admin-transit/image/icon_station/red-purple-yellow.png';
        var BS_B1G = '/admin-transit/image/icon_station/B1G_busstop.png';
        var BS_B1B = '/admin-transit/image/icon_station/B1B_busstop.png';
        var BS_B2G = '/admin-transit/image/icon_station/B2G_busstop.png';
        var BS_B2B = '/admin-transit/image/icon_station/B2B_busstop.png';
        var BS_B3G = '/admin-transit/image/icon_station/B3G_busstop.png';
        var BS_B3B = '/admin-transit/image/icon_station/B3G_busstop.png';
        var BS_KWG = '/admin-transit/image/icon_station/KWG_busstop.png';
        var BS_special = '/admin-transit/image/icon_station/BS_special.png';

        //strokeWeight
        var strokeWeight = 4.0;
        var icon = null;


        function station(route) {
            var check = false;
            if(route==null){
                check = true;
            }
            $.getJSON("/admin-transit/API/JSON/station/", function(jsonCM1) {

                $.each(jsonCM1, function(i, station1) {
                    if(station1.type==route||check==true){
                    // if(check_obj(station1.station_name)=="R1P-R3Y"){
                    //     var icon = Purple_Yellow;
                    // }
                    // else if(check_obj(station1.station_name)=="R1P-R3R"){
                    //     var icon = Red_Purple;
                    // }
                    // else if(check_obj(station1.station_name)=="R1P-R3R-R3Y"){
                    //     var icon =  Red_Purple_Yellow;
                    // }
                    if(check_obj(station1.station_name)=="R1P"){
                        var icon = BS_R1P;
                    }
                    // else if(check_obj(station1.station_name)=="R1G-R3R"){
                    //     var icon = Red_Green;
                    // }
                    else if(check_obj(station1.station_name)=="R1G"){
                        var icon = BS_R1G;
                    }
                    // else if(check_obj(station1.station_name)=="R1P-R3Y"){
                    //     var icon = Purple_Yellow;
                    // }
                    else if(check_obj(station1.station_name)=="R3Y"){
                        var icon = BS_R3Y;
                    }else if(check_obj(station1.station_name)=="R3R"){
                        var icon = BS_R3R;
                    }
                    else if(check_obj(station1.station_name)=="R2P"){
                        var icon = BS_R2P;
                    }
                    else if(check_obj(station1.station_name)=="R2B"){
                        var icon = BS_R2B;
                    }
                    // else if(check_obj(station1.station_name)=="R2P-R2B"){
                    //     var icon = Pink_Brown;
                    // }
                    // else if(check_obj(station1.station_name)=="R3R-R3Y"){
                    //     var icon = Yellow_Red;
                    // }
                    else if(check_obj(station1.station_name)=="B1G"){
                        var icon = BS_B1G;
                    }
                    else if(check_obj(station1.station_name)=="B1B"){
                        var icon = BS_B1B;
                    }
                    else if(check_obj(station1.station_name)=="B2G"){
                        var icon = BS_B2G;
                    }
                    else if(check_obj(station1.station_name)=="B2B"){
                        var icon = BS_B2B;
                    }
                    else if(check_obj(station1.station_name)=="B3G"){
                        var icon = BS_B3G;
                    }
                    else if(check_obj(station1.station_name)=="B3B"){
                        var icon = BS_B3B;
                    }
                    else if(check_obj(station1.station_name)=="KWG"){
                        var icon = BS_KWG;
                    }else {
                        var icon = BS_special;
                    }



                    var marker1 = new google.maps.Marker({
                        position: new google.maps.LatLng(station1.station_lat, station1.station_lng),
                        map: map,
                        title: station1.station_name,
                        icon: icon
                    });

                    var str = check_obj(station1.station_name);
                    var content = '';
                    var res = str.split("-");
                    console.log(res[1]);
                    if(res[1]!=null){
                        for (var i = 0; i <= res.length-1; i++) {
                            content += "<br> สาย "+res[i];
                        }
                    }else{
                        content = "<br> สาย "+str;
                    }

                    markers.push(marker1);
                    info = new google.maps.InfoWindow();
                    google.maps.event.addListener(marker1, 'click', (function(marker1, i) {
                        return function() {
                            info.setContent(station1.station_name +content);

                            info.open(map, marker1);
                        }
                    })(marker1, i));
                    }
                });

                });
        }

        function addAll_Path() {

            station();

            // $.getJSON("/admin-transit/API/JSON/station/", function(jsonCM1) {
            //
            //     $.each(jsonCM1, function(i, station1) {
            //
            //         if(check_obj(station1.station_name)=="R1P-R3Y"){
            //             var icon = Purple_Yellow;
            //
            //         }
            //         else if(check_obj(station1.station_name)=="R1P-R3R"){
            //             var icon = Red_Purple;
            //         }
            //         else if(check_obj(station1.station_name)=="R1P-R3R-R3Y"){
            //             var icon =  Red_Purple_Yellow;
            //         }
            //         else if(check_obj(station1.station_name)=="R1P"){
            //             var icon = BS_R1P;
            //         }
            //         else if(check_obj(station1.station_name)=="R1G-R3R"){
            //             var icon = Red_Green;
            //         }
            //         else if(check_obj(station1.station_name)=="R1G"){
            //             var icon = BS_R1G;
            //         }
            //         else if(check_obj(station1.station_name)=="R1P-R3Y"){
            //             var icon = Purple_Yellow;
            //         }
            //         else if(check_obj(station1.station_name)=="R3Y"){
            //             var icon = BS_R3Y;
            //         }else if(check_obj(station1.station_name)=="R3R"){
            //             var icon = BS_R3R;
            //         }
            //         else if(check_obj(station1.station_name)=="R2P"){
            //             var icon = BS_R2P;
            //         }
            //         else if(check_obj(station1.station_name)=="R2B"){
            //             var icon = BS_R2B;
            //         }
            //         else if(check_obj(station1.station_name)=="R2P-R2B"){
            //             var icon = Pink_Brown;
            //         }
            //         else if(check_obj(station1.station_name)=="R3R-R3Y"){
            //             var icon = Yellow_Red;
            //         }
            //         else if(check_obj(station1.station_name)=="B1G"){
            //             var icon = BS_B1G;
            //         }
            //         else if(check_obj(station1.station_name)=="B1B"){
            //             var icon = BS_B1B;
            //         }
            //         else if(check_obj(station1.station_name)=="B2G"){
            //             var icon = BS_B2G;
            //         }
            //         else if(check_obj(station1.station_name)=="B2B"){
            //             var icon = BS_B2B;
            //         }
            //         else if(check_obj(station1.station_name)=="B3G"){
            //             var icon = BS_B3G;
            //         }
            //         else if(check_obj(station1.station_name)=="B3B"){
            //             var icon = BS_B3B;
            //         }
            //         else if(check_obj(station1.station_name)=="KWG"){
            //             var icon = BS_KWG;
            //         }else {
            //             var icon = BS_special;
            //         }
            //
            //
            //
            //         var marker1 = new google.maps.Marker({
            //             position: new google.maps.LatLng(station1.station_lat, station1.station_lng),
            //             map: map,
            //             title: station1.station_name,
            //             icon: icon
            //         });
            //
            //        var str = check_obj(station1.station_name);
            //        var content = null;
            //         var res = str.split("-");
            //         console.log(res[1]);
            //         if(res[1]!=null){
            //         for (var i = 0; i <= res.length-1; i++) {
            //             content += "<br> สาย "+res[i];
            //         }
            //         }else{
            //             content = "<br> สาย "+str;
            //         }
            //
            //         markers.push(marker1);
            //         info = new google.maps.InfoWindow();
            //         google.maps.event.addListener(marker1, 'click', (function(marker1, i) {
            //             return function() {
            //                 info.setContent(station1.station_name+content);
            //
            //                 info.open(map, marker1);
            //             }
            //         })(marker1, i));
            //
            //     });
            // });

            var route = (function () {
                var route = null;
                $.ajax({
                    'async': false,
                    'global': false,
                    'url': "/admin-transit/API/JSON/route/",
                    'dataType': "json",
                    'success': function (data) {
                        route = data;
                    }
                });
                return route;
            })();




            var obj = []

            var route_color = null;
            var old_type = null;



            for (var i = 0; i < route.length-1; i++) {


                var route_line = {
                    lat: parseFloat(route[i].lat),
                    lng: parseFloat(route[i].lng)
                };


                if(old_type==null){
                    old_type = route[i].type;
                }

                if(old_type!=route[i].type){
                    obj = [];
                    old_type = route[i].type;
                    flightAllPath.push(flightPath);
                }

                var c = search(route[i].type,json_route);
                // console.log(c);
                if(c.check){
                    route_color= c.route_color;
                    obj.push(route_line);
                }


                flightPath = new google.maps.Polyline({
                    path: obj,
                    strokeColor: route_color,
                    strokeOpacity: 1.0,
                    strokeWeight: strokeWeight
                });



            }

            for(var i = 0; i <= flightAllPath.length-1; i++){
                flightAllPath[i].setMap(map);

            }


        }

        //
        var search = function(nameKey, myArray) {
            for (var i=0; i <= myArray.length-1; i++) {
                if (myArray[i].route_code === nameKey) {
                    var check = true;
                    var route_color = myArray[i].routh_color;
            return {
                check: check,
                route_color: route_color
            };
                }
            }
        };



        function addLine() {
            flightPath.setMap(map);
        }

        function removeLine() {
            for(var i = 0; i <= flightAllPath.length-1; i++){
                flightAllPath[i].setMap(null);
            }
            flightPath.setMap(null);
        }

        function getInfo(carB1) {
            if(carB1.StatusLogInOut == 'I'){
                carB1.StatusLogInOut = 'Login';
            }
            else{
                carB1.StatusLogInOut = 'Logout';
            }

            if(carB1.CM_Engine == 1){
                carB1.CM_Engine = 'ปกติ';
            }
            else{
                carB1.CM_Engine = 'ดับเครื่องยนต์';
            }

            if(carB1.CM_Battery == 1){
                carB1.CM_Battery = 'ปกติ';
            }
            else{
                carB1.CM_Battery = 'ไม่ปกติ';
            }

            if(carB1.SignalFall == 0){
                carB1.SignalFall = 'สัญญาณปกติ ข้อมูลถูกต้อง';
            }
            else if(carB1.SignalFall == 1){
                carB1.SignalFall = 'สัญญาณขาดหาย';
            }

            else if(carB1.SignalFall == 2){
                carB1.SignalFall = 'ตำแหน่งคลาดเคลื่อน';
            }
            else if(carB1.SignalFall == 3){
                carB1.SignalFall = 'เฝ้าระวัง';
            }
            else if(carB1.SignalFall == 'F'){
                carB1.SignalFall = 'สัญญาณขาดหายเกิน 12 ชั่วโมง';
            }

            info.setContent('' +
                '<div id="content">' +
                '<h2 style="color: blue">' + carB1.Registerid + '</h2>' +
                '</div> <hr> ' +
                'สาย: '+ carB1.Detail + '<br>'+
                'ข้อมูลล่าสุด:' + carB1.Date +':' + carB1.Time +'<br>' +
                'ข้อมูลผู้ขับ: '+ carB1.DriverName + ' สถานะ: '+ carB1.StatusLogInOut + '<br> <hr>'+
                'เครื่องยนต์: '+ carB1.CM_Engine + '<br>'+
                'แบตเตอร์รี่: '+ carB1.CM_Battery + '<br>'+
                'น้ำมัน: '+ carB1.Fuel + '<br>'+
                'อุณหภูมิ: '+ '' + '<br>'+
                'เซ็นเซอร์ฝุ่นละออง: '+ carB1.SensorPM + '<br> <hr>'+
                'GSM: '+ '' + '<br>'+
                'GPS: '+ '' + '<br>'+
                'สถานะ: '+ carB1.SignalFall + '<br> <hr>'+
                'ตำแหน่ง: '+ '' + '<br>'+
                'พิกัด: ('+ carB1.LaGoogle +','+ carB1.LongGoogle +')<br> <hr>'+ carB1.Type);
        };

        function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }


        function setMapOnCar(map) {
            for (var i = 0; i < carMark.length; i++) {
                carMark[i].setMap(map);
            }
        }


        function clearMarkers() {
            setMapOnAll(null);
        }

        function clearMarkCar() {
            setMapOnCar(null);
        }

        var Interval;
        var IntervalBegin = setInterval(function () {
            getCarlocation();
        }, 10000);

        function getCar(type) {
            clearInterval(IntervalBegin);
            clearMarkCar();
            if(Interval == null) {
                getCarlocation(type);
                clearInterval(Interval);
                Interval = setInterval(function () {
                    getCarlocation(type);
                }, 5000);
            }
            else{
                clearInterval(Interval);
                getCarlocation(type);
                Interval = setInterval(function () {
                    getCarlocation(type);
                }, 5000);
            }

        }

        function getCarlocation(type) {
            console.log(car);
            $.getJSON("/admin-transit/CM_CAR/API", function(jsonBus1) {
                clearMarkCar();
                carMark = [];
                $.each(jsonBus1, function(i, carB1) {
                    if(carB1.Type == "minibus") {
                        var color = "#0d0c55";
                    }
                    if(carB1.Type == "bus") {

                        if(carB1.Color=="เขียว"){
                            var color = "#055500";
                        }
                        if(carB1.Color=="เหลือง"){
                            var color = '#ffff07';
                        }
                        if(carB1.Color=="แดง"){
                            var color = '#fe0404';
                        }
                        if(carB1.Color=="น้ำเงิน"){
                            var color = "#515aee";
                        }
                    }

                    if(carB1.Type == type) {
                        var markBusB1 = new google.maps.Marker({
                            position: new google.maps.LatLng(carB1.LaGoogle, carB1.LongGoogle),
                            map: map,
                            title: carB1.Registerid,
                            icon: {
                                                               // path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
		path: car_symbol,
                                //scale: 5,
		scale: .7,
                                strokeColor: 'white',
                                strokeWeight: .01,
                                fillOpacity: 1,
                                fillColor: color,
                                // offset: '5%',
                                rotation: parseFloat(carB1.Direction)
                            }
                        });
                        carMark.push(markBusB1);
                        info = new google.maps.InfoWindow();
                        google.maps.event.addListener(markBusB1, 'click', (function (markBusB1, i) {
                            return function () {
                                getInfo(carB1);
                                info.open(map, markBusB1);
                            }
                        })(markBusB1, i));
                    }

                    if(type == null) {

                        if(carB1.Type=="bus"||carB1.Type=="minibus"||carB1.Type=="kwvan") {
                            if(carB1.Color==car){
                                var markBusB1 = new google.maps.Marker({
                                    position: new google.maps.LatLng(carB1.LaGoogle, carB1.LongGoogle),
                                    map: map,
                                    title: carB1.Registerid,
                                    icon: {
                                                                      // path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
		path: car_symbol,
                                //scale: 5,
		scale: .7,
                                        strokeColor: 'white',
                                        strokeWeight: .01,
                                        fillOpacity: 1,
                                        fillColor: color,
                                        // offset: '5%',
                                        rotation: parseFloat(carB1.Direction)
                                    }
                                });

                                carMark.push(markBusB1);
                                info = new google.maps.InfoWindow();
                                google.maps.event.addListener(markBusB1, 'click', (function (markBusB1, i) {
                                    return function () {
                                        getInfo(carB1);
                                        info.open(map, markBusB1);
                                    }
                                })(markBusB1, i));
                            }
                            if(car=="all"){
                                var markBusB1 = new google.maps.Marker({
                                    position: new google.maps.LatLng(carB1.LaGoogle, carB1.LongGoogle),
                                    map: map,
                                    title: carB1.Registerid,
                                    icon: {
                                                                 // path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
		path: car_symbol,
                                //scale: 5,
		scale: .7,
                                        strokeColor: 'white',
                                        strokeWeight: .01,
                                        fillOpacity: 1,
                                        fillColor: color,
                                        // offset: '5%',
                                        rotation: parseFloat(carB1.Direction)
                                    }
                                });

                                carMark.push(markBusB1);
                                info = new google.maps.InfoWindow();
                                google.maps.event.addListener(markBusB1, 'click', (function (markBusB1, i) {
                                    return function () {
                                        getInfo(carB1);
                                        info.open(map, markBusB1);
                                    }
                                })(markBusB1, i));
                            }



                        }
                    }
                });
            });
        }

    </script>
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCeIm4Qr_eDTBDnE55Q1DJbZ4qXZLYjss&callback=initMap"
            async defer>
    </script>

</body>

</html>
