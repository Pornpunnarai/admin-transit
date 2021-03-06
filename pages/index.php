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

<canvas id="canvas" width="36" height="36" style="display: none;"></canvas>
<div id="wrapper">

    <?php include 'navbar.php' ?>

    <div id="page-wrapper">

        <!-- Page Content -->
        <div class="container-fluid">
            <ol class="breadcrumb" style="margin-top: 1rem;">
                <li class="breadcrumb-item active" style="height: 35px">Map</li>
                <button style="float: right" class="btn btn-primary" onclick="icon_off()">Icon</button>
            </ol>



            <div class="embed-responsive embed-responsive-16by9">
                <div id="map" class="embed-responsive-item" style="overflow: hidden;">
                </div>
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


    var json_car = (function () {
        var json_car = null;
        $.ajax({
            'async': false,
            'global': false,
            'url': "/admin-transit/API/test.php",
            'dataType': "json",
            'success': function (data) {
                // console.log(data);
                json_car = data;
            },
            'error': function (data) {
                console.log(data);
            }
        });
        return json_car;
    })();

console.log(json_car);


    var map;
    var flightAllPath = [];
    var flightPath;
    var info_array = [];
    var info;
    var line = null;
    var markers = [];
    var carMark = [];

    var sB1 = '/admin-transit/image/icon_car/bus.png';
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

        var location = {
            lat: 18.787635,
            lng: 98.985683
        };
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            center: location
        });
        map.setOptions({ minZoom: 12, maxZoom: 19 });


        // $.getJSON("/admin-transit/CM_CAR/API", function(jsonBus1) {
        //     $.each(jsonBus1, function(i, carB1) {
        //
        //
        //         if(carB1.Type == "bus"||carB1.Type=="minibus"||carB1.Type=="kwvan"){
        //             var markBusB1 = new google.maps.Marker({
        //                 position: new google.maps.LatLng(carB1.LaGoogle, carB1.LongGoogle),
        //                 map: map,
        //                 title: carB1.Registerid,
        //                 icon: drawRotated(carB1.Direction,carB1.Detail)
        //             });
        //
        //
        //             carMark.push(markBusB1);
        //             info = new google.maps.InfoWindow();
        //
        //             google.maps.event.addListener(markBusB1, 'click', (function(markBusB1, i) {
        //                 return function() {
        //                     getInfo(carB1);
        //                     info.open(map, markBusB1);
        //                 }
        //             })(markBusB1, i));
        //         }
        //
        //     });
        // });
        car = "all";
        getCarlocation();
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
        if(route!="all") {
            removeLine();
            clearMarkers();
            markers = [];
            addR1_Back(route);
            setMapOnCar(null);
            car = route;
            getCarlocation();

        }else {
            removeLine();
            clearMarkers();
            markers = [];
            addAll_Path();
            setMapOnCar(null);
            car = "all";
            getCarlocation();
        }
    }

    function addR1_Back(route) {
        var myTrip=new Array();
        var lat = new Array();
        var long = new Array();
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

    var BS_special = '/admin-transit/image/icon_station/R3R_busstop.png';
    function icon_off(){
        if(BS_special == '/admin-transit/image/icon_station/R3R_busstop.png'){
            BS_special = '/admin-transit/image/icon_station/point.png';
        }else{
            BS_special = '/admin-transit/image/icon_station/R3R_busstop.png'
        }
        removeLine();
        clearMarkers();
        markers = [];
        route(car)
        if(car=="all"){
            addAll_Path();
        }
    }




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

                    // For Aj.Poon
                    var icon = BS_special;

                    var marker1 = new google.maps.Marker({
                        position: new google.maps.LatLng(station1.station_lat, station1.station_lng),
                        map: map,
                        title: station1.station_name,
                        icon: icon
                    });

                    var str = check_obj(station1.station_name);
                    var content = '';
                    var res = str.split("-");
                    // console.log(res[1]);
                    if(res[1]!=null){
                        for (var i = 0; i <= res.length-1; i++) {
                            if(res[i-1]!=res[i]){
                                content += "<br> สาย "+res[i];
                            }
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



        for (var i = 0; i <= route.length-1; i++) {


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
                // if(route[i].type=="R3R"){
                route_color= c.route_color;
                obj.push(route_line);
                // }

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
            'พิกัด: ('+ carB1.LaGoogle +','+ carB1.LongGoogle +')<br> <hr>'+
            'ประเภทรถ: '+ carB1.Type +'<br>'+
            'สถาณีต่อไป: '+ carB1.busstop +'<br>'+
            'ระยะเวลา: '+ carB1.datetime_busstop +' นาที <br>'
        );
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
    // var IntervalBegin = setInterval(function () {
    //     getCarlocation();
    // }, 3000);




    function closeAllInfoWindows() {
        for (var i=0;i<=info_array.length-1;i++) {
            info_array[i].close();
        }
    }

    var car_select = null;
    function getCarlocation(type) {
        if(car_select!=null){
        closeAllInfoWindows();
            google.maps.event.trigger(car_select, 'click');
        }
        var icon = null;
        var icon_type = null;

        //station estimate time
        // clearMarkers();
        // markers = [];
        // if(car=="all"){
        //     station();
        // }else{
        // station(car);
        // }

        $.getJSON("/admin-transit/CM_CAR/API", function(jsonBus1) {
            clearMarkCar();
            carMark = [];
            $.each(jsonBus1, function(i, carB1) {
                //test map
// if(carB1.Registerid=="10-7116"){
//                     map.setCenter({ lat: parseFloat(carB1.LaGoogle), lng: parseFloat(carB1.LongGoogle) });
//     map.setZoom(19);
// }
                if(type == null) {

                    if(carB1.Type=="bus"||carB1.Type=="minibus"||carB1.Type=="kwvan") {
                        var car_check = null;
                        var bypass = false;
                        var by_passcheck = null;
                        if(car=="R1G"||car=="R1P"){

                            car_check  = "R1";
                            icon_type = "R1G";
                        }
                        if(car=="R2P"||car=="R2B"){
                            car_check = "R2";
                            icon_type = "R2P";

                        }
                        if(car=="R3Y"){
                            car_check = "R3-Y";
                            icon_type = "R3Y";
                        }
                        if(car=="R3R"){
                            car_check = "R3-R";
                            icon_type = "R3R";
                        }

                        if(car=="B1G"||car=="B1B")
                        {
                            if(carB1.Detail=="B1,2"||carB1.Detail=="B1,6"||carB1.Detail=="B1,3" ||carB1.Detail=="B1,1"
                                ||carB1.Detail=="B1,5"||carB1.Detail=="B1,4") {
                                bypass = true;
                                by_passcheck = "minibus"
                                icon_type = "minibus";
                            }
                        }
                        if(car=="B2G" ||car=="B2B")
                        {
                            if(carB1.Detail=="B2,5"||carB1.Detail=="B2,1"|| carB1.Detail=="B2,4"
                                ||carB1.Detail=="B2,6"||carB1.Detail=="B2,2"||carB1.Detail=="B2,3"){
                                bypass = true;
                                by_passcheck = "minibus"
                                icon_type = "minibus";
                            }
                        }
                        if(car=="B3G" ||car=="B3B")
                        {
                            if(carB1.Detail=="B3,30"||carB1.Detail=="B3,33"||carB1.Detail=="B3,34"||carB1.Detail=="B3,37"){
                                bypass = true;
                                by_passcheck = "minibus"
                                icon_type = "minibus";
                            }
                        }


                        if(car=="KWG")
                        {
                            bypass = true;
                            by_passcheck = "kwvan"
                            icon_type = "KWG";
                        }


                        if(carB1.Detail=="R1"){
                            icon_type = "R1G";
                        }
                        if(carB1.Detail=="R2"){
                            icon_type = "R2P";
                        }
                        if(carB1.Detail=="R3-Y"){
                            icon_type = "R3Y";
                        }
                        if(carB1.Detail=="R3-R"){
                            icon_type = "R3R";
                        }

                        if(carB1.Detail=="B1,2"||carB1.Detail=="B1,6"||carB1.Detail=="B1,3" ||carB1.Detail=="B1,1"
                            ||carB1.Detail=="B1,5"||carB1.Detail=="B1,4")
                        {
                            icon_type = "minibus";
                        }
                        if(carB1.Detail=="B2,5"||carB1.Detail=="B2,1"|| carB1.Detail=="B2,4"
                            ||carB1.Detail=="B2,6"||carB1.Detail=="B2,2"||carB1.Detail=="B2,3")
                        {
                            icon_type = "minibus";
                        }
                        if(carB1.Detail=="B3,30"||carB1.Detail=="B3,33"||carB1.Detail=="B3,34"||carB1.Detail=="B3,37")
                        {
                            icon_type = "minibus";
                        }


                        if(carB1.Detail=="")
                        {
                            icon_type = "KWG";
                        }

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


                        if(bypass){
                            if(carB1.Type==by_passcheck){
                                var markBusB1 = new google.maps.Marker({
                                    position: new google.maps.LatLng(carB1.LaGoogle, carB1.LongGoogle),
                                    map: map,
                                    title: carB1.Registerid,
                                    icon: icon
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


                        if(carB1.Detail==car_check){
                            // console.log(car_check);
                            var markBusB1 = new google.maps.Marker({
                                position: new google.maps.LatLng(carB1.LaGoogle, carB1.LongGoogle),
                                map: map,
                                title: carB1.Registerid,
                                icon: icon
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
                                icon: icon
                            });
                            carMark.push(markBusB1);
                            info = new google.maps.InfoWindow();
                            google.maps.event.addListener(markBusB1, 'click', (function (markBusB1, i) {
                                return function () {
closeAllInfoWindows();
                                    car_select = markBusB1;
                                    getInfo(carB1);
                                    info_array.push(info);
                                    info.open(map, markBusB1);
                                    info_array[info_array.length-1].open(map, markBusB1);

                                }
                            })(markBusB1, i));



                        }



                    }


                }

            });
        });
        setTimeout(getCarlocation, 5000);
    }


    var canvas=document.getElementById("canvas");
    var ctx=canvas.getContext("2d");



    function drawRotated(degrees,route_code){


        if(route_code=="R1"){
            route_code = "R1G";
        }
        if(route_code=="R2"){
            route_code = "R2B";
        }
        if(route_code=="R3-Y"){
            route_code = "R3Y";
        }
        if(route_code=="R3-R"){
            route_code = "R3R";
        }





        if(route_code=="B1,2"||route_code=="B1,6"||route_code=="B1,3" ||route_code=="B1,1"
            ||route_code=="B1,5"||route_code=="B1,4" ||route_code=="B2,5"||route_code=="B2,1"||
            route_code=="B2,4" ||route_code=="B2,6"||route_code=="B2,2"||route_code=="B2,3"
            ||route_code=="B3,30"||route_code=="B3,33"||route_code=="B3,34"||route_code=="B3,37"){
            route_code = "Minibus"


        }
        if(route_code==""){
            route_code = "KWG";
        }
        if(route_code=="สำรอง"){
            route_code = "R2B";
        }


        if(route_code=="minibus"){
            route_code = "Minibus";
        }
        if(route_code=="kwvan"){
            route_code = "KWG";
        }
        var image=document.createElement("img");
        image.src= '/admin-transit/image/icon_car/'+route_code+'.png';

        ctx.clearRect(0,0,canvas.width,canvas.height);
        ctx.save();
        ctx.translate(canvas.width/2,canvas.height/2);
        ctx.rotate(degrees*Math.PI/180);
        ctx.drawImage(image,-image.width/2,-image.width/2);
        ctx.restore();



        return canvas.toDataURL();

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
