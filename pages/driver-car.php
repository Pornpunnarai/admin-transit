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


</head>

<body>
<canvas id="canvas" width="36" height="36" style="display: none;"></canvas>
    <div id="wrapper">

        <?php include 'navbar2.php' ?>

        <div id="page-wrapper">

            <!-- Page Content -->
            <div class="container-fluid">
                <ol class="breadcrumb" style="margin-top: 1rem;">
                    <li class="breadcrumb-item active">Driver & Car</li>
                </ol>

                <div class="col-lg-12" style="background-color: white; padding: 1%">
                    <div class="col-lg-6">

                        <div class="row">
                            <h4>ข้อมูลคนขับรถ</h4>


                            <div class="col-lg-2">
                                <img src="/admin-transit/image/avatar.png" width="100%">
                            </div>

                            <div id="driver" class="col-lg-10">
                            </div>


                        </div>
                        <br>
                        <div class="row">
                            <div class="embed-responsive embed-responsive-16by9">
                                <div id="map" class="embed-responsive-item" style="overflow: hidden;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="col-lg-12" style="background-color: #ccc">
                            <h4 class="text-center">ข้อมูลรถ</h4>

                                <table id="createTable" class="table table-bordered" style="text-align: center">

                                </table>

                            <script>
                                createTable();
                                // setInterval(function(){createTable();}, 5000);
                                function createTable() {

                                    var Parent = document.getElementById("createTable");
                                    while(Parent.hasChildNodes())
                                    {
                                        Parent.removeChild(Parent.firstChild);
                                    }

                                    var json_route = (function () {
                                        var json_route = null;
                                        $.ajax({
                                            'async': false,
                                            'global': false,
                                            'url': "/admin-transit/CM_CAR/API",
                                            'dataType': "json",
                                            'success': function (data) {
                                                json_route = data;
                                            }
                                        });
                                        return json_route;
                                    })();

                                    var table = document.getElementById("createTable");
                                    var header = table.createTHead();
                                    var row = header.insertRow(0);
                                    var cell1 = row.insertCell(0);
                                    var cell2 = row.insertCell(1);
                                    var cell3 = row.insertCell(2);
                                    var cell4 = row.insertCell(3);
                                    var cell5 = row.insertCell(4);
                                    var cell6 = row.insertCell(5);

                                    cell1.innerHTML = "<b>Car ID</b>";
                                    cell2.innerHTML = "<b>Type</b>";
                                    cell3.innerHTML = "<b>Status</b>";
                                    cell4.innerHTML = "<b>Login Time</b>";
                                    cell5.innerHTML = "<b>Logout Time</b>";
                                    cell6.innerHTML = "<b>Infomation</b>";

                                    for(var i = 0;i<=json_route.length-1;i++){
                                    if(json_route[i].Type=="bus"||json_route[i].Type=="minibus"||json_route[i].Type=="kwvan"){
                                        var row = table.insertRow(1);
                                        var cell1 = row.insertCell(0);
                                        var cell2 = row.insertCell(1);
                                        var cell3 = row.insertCell(2);
                                        var cell4 = row.insertCell(3);
                                        var cell5 = row.insertCell(4);
                                        var cell6 = row.insertCell(5);
                                        // var cell5 = row.insertCell(4);
                                        cell1.innerHTML = json_route[i].Registerid;
                                        cell2.innerHTML = json_route[i].Detail;
                                        var status = "";
                                        if(json_route[i].StatusLogInOut=="I"){
                                             status = "<button class=\"btn btn-success btn-circle\"></button>";
                                        }else{
                                             status = "<button class=\"btn btn-danger btn-circle\"></button>";
                                        }
                                        cell3.innerHTML = status;
                                        cell4.innerHTML = json_route[i].LogIn;
                                        cell5.innerHTML = json_route[i].LogOut;
                                        cell6.innerHTML = "<button class=\"btn btn-primary\" onclick=\"driver('" +
                                            json_route[i].Registerid +
                                            "')\">Info</button>";
                                        // cell5.innerHTML = json_route[i].IDCar;
                                    }
                                    }
                                }
                            </script>

                        </div>

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


            var Interval;
            var IntervalBegin = setInterval(function () {
                getCarlocation();
            }, 2000);


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

        var car_id = null;
        function driver(idCar) {
            car_id = idCar;
            console.log("driver",car_id);
        }

        function getCarlocation(type) {

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

                        if(carB1.Registerid==car_id){
                            var button = '';
                            if(carB1.StatusLogInOut=="I"){
                                 button = '<button class="btn btn-success btn-circle"></button>';
                            }else{
                                 button = '<button class="btn btn-danger btn-circle"></button>';
                            }
                            console.log(car_id);
                            document.getElementById("driver").innerHTML =
                                "      <h4>Name : "+ carB1.DriverName +"</h4>\n" +
                                "                                <h4>ID Card : "+ carB1.DriverIDCard +"</h4>\n" +
                                "                                <h4>Status Login/Logout :"+ button +"</h4>\n" +
                                "                                <h4>Car Id : "+carB1.Registerid+"</h4>\n" +
                                "                                <h4>Type : "+carB1.Type+"</h4>\n" +
                                "                                <h4>Fast : "+carB1.Fast+" </h4>\n" +
                                "                                <h4>Latitude : "+carB1.LaGoogle+"</h4>\n" +
                                "                                <h4>Longitude : "+carB1.LongGoogle+"</h4>"+
                            "                                <h4>Next Station : "+carB1.busstop+"</h4>\n" +
                            "                                <h4>Estimate Time : "+carB1.datetime_busstop+" min</h4>";



                    map.setCenter({ lat: parseFloat(carB1.LaGoogle), lng: parseFloat(carB1.LongGoogle) });
                    map.setZoom(19);


                        }


                        if(carB1.Type=="bus"||carB1.Type=="minibus"||carB1.Type=="kwvan") {
                            var car_check = null;
                            var bypass = false;
                            var by_passcheck = null;
                            if(car=="R1G"||car=="R1P"){

                                car_check  = "R1";

                            }
                            if(car=="R2P"||car=="R2B"){
                                car_check = "R2";

                            }
                            if(car=="R3Y"){
                                car_check = "R3-Y";
                            }
                            if(car=="R3R"){
                                car_check = "R3-R";
                            }

                            if(car=="B1G"||car=="B1B")
                            {
                                if(carB1.Detail=="B1,2"||carB1.Detail=="B1,6"||carB1.Detail=="B1,3" ||carB1.Detail=="B1,1"
                                    ||carB1.Detail=="B1,5"||carB1.Detail=="B1,4") {
                                    bypass = true;
                                    by_passcheck = "minibus"
                                }
                            }
                            if(car=="B2G" ||car=="B2B")
                            {
                                if(carB1.Detail=="B2,5"||carB1.Detail=="B2,1"|| carB1.Detail=="B2,4"
                                    ||carB1.Detail=="B2,6"||carB1.Detail=="B2,2"||carB1.Detail=="B2,3"){
                                    bypass = true;
                                    by_passcheck = "minibus"
                                }
                            }
                            if(car=="B3G" ||car=="B3B")
                            {
                                if(carB1.Detail=="B3,30"||carB1.Detail=="B3,33"||carB1.Detail=="B3,34"||carB1.Detail=="B3,37"){
                                    bypass = true;
                                    by_passcheck = "minibus"
                                }
                            }


                            if(car=="KWG")
                            {
                                bypass = true;
                                by_passcheck = "kwvan"
                            }



                            if(bypass){
                                if(carB1.Type==by_passcheck){
                                    var markBusB1 = new google.maps.Marker({
                                        position: new google.maps.LatLng(carB1.LaGoogle, carB1.LongGoogle),
                                        map: map,
                                        title: carB1.Registerid,
                                        icon: drawRotated(carB1.Direction,carB1.Type)
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
                                    icon: drawRotated(carB1.Direction,car)
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
                                    icon: drawRotated(carB1.Direction,carB1.Detail)
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
