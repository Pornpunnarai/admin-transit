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


var position = {lat: 18.787635, lng: 98.985683};
var array_result = [];
var array_marker = [];
var array_postion = [];
var array_delta = [];
var icon = null;
var interval = null;
var flightAllPath = [];
var flightPath;
var BS_special = '/admin-transit/image/icon_station/R3R_busstop.png';
var array_station = [];
var icon_current = "all";
function initialize() {


    var latlng = new google.maps.LatLng(position.lat, position.lng);
    var myOptions = {
        zoom: 16,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("mapCanvas"), myOptions);
    info = new google.maps.InfoWindow();

    route("all");
}

function setMapOnCar(map) {
    for (var i = 0; i <= array_marker.length-1; i++) {
        array_marker[i].setMap(map);
    }
    array_result = [];
    array_marker = [];
    array_postion = [];
    array_delta = [];
}


function route(route) {
    icon_current = route;
console.log(route);
    clearInterval(interval);
    removeLine();
    setMapOnCar(null);

    interval = setInterval(function() {
            var xi = 0;
            $.getJSON("/admin-transit/CM_CAR/API", function(jsonBus1) {
                $.each(jsonBus1, function(i, carB1) {
                    if(carB1.busstop!=null){
                        console.log(carB1.busstop);
                    }

//for cm transit only
                    if(carB1.Type=="minibus"||carB1.Type=="bus"||carB1.Type=="kwvan") {

                        if (convert_car_detail(carB1.Detail) == route||route=="all") {
                            array_result[xi] = {
                                lat: parseFloat(carB1.LaGoogle), lng: parseFloat(carB1.LongGoogle)
                                , direction: parseFloat(carB1.Direction), type: carB1.Detail,busstop: carB1.busstop
                            };
                            xi++;
                        }
                    }

                });
            });

            transition(array_result);

        },
        2000);

    var x = 0;
    var old_open = null;
    for (var i = 0; i <= car.length-1; i++) {
        //for cm transit only
        if(car[i].Type=="minibus"||car[i].Type=="bus"||car[i].Type=="kwvan") {
            if (convert_car_detail(car[i].Detail) == route||route=="all") {
                var positions = {lat: parseFloat(car[i].LaGoogle), lng: parseFloat(car[i].LongGoogle)};
                array_postion.push(positions);

                latlng = new google.maps.LatLng(parseFloat(car[i].LaGoogle), parseFloat(car[i].LongGoogle));
                marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    title: "Latitude:" + position.lat + " | Longitude:" + position.lng,
                    icon: check_direction(car[i].Direction, car[i].Detail)
                });
                var content = '<span id="rating' + x + '">www<span>';
                marker['infowindow'] = new google.maps.InfoWindow({
                    content: content
                });

                x++;
                google.maps.event.addListener(marker, 'click', function (e) {
                    if (old_open != null) {
                        old_open.close()
                    }
                    this['infowindow'].open(map, this);
                    old_open = this['infowindow'];

                });

                array_marker.push(marker);

            }

        }
    }


    drawPolyLine(route);
    station(route);
}


function drawPolyLine(route) {

    var myTrip=new Array();



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

    //line color
    var route_color;
    for (var i = 0; i <= json_route.length-1; i++) {

        if (route==json_route[i].route_code) {
            route_color = json_route[i].routh_color;
        }
    }

    var old_type = null;
    $.getJSON("/admin-transit/API/JSON/route/", function(jsonCM1) {
        $.each(jsonCM1, function(i, polyline) {
            if(polyline.type==route){
                myTrip.push(new google.maps.LatLng(polyline.lat,polyline.lng));
                flightPath = new google.maps.Polyline({
                    path: myTrip,
                    strokeColor: route_color,
                    strokeOpacity: 1.0,
                    strokeWeight: 2.0
                });
                flightAllPath = [];
                flightAllPath.push(flightPath);
            }
            if(route=="all"){
                if(old_type==null){

                    old_type = polyline.type;

                }

                if(old_type!=polyline.type){

                    myTrip = [];
                    old_type = polyline.type;
                    flightAllPath.push(flightPath);
                }

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

                var c = search(polyline.type,json_route);


                if(c.check){
                    route_color= c.route_color;
                    myTrip.push(new google.maps.LatLng(polyline.lat,polyline.lng));

                }

                flightPath = new google.maps.Polyline({
                    path: myTrip,
                    strokeColor: route_color,
                    strokeOpacity: 1.0,
                    strokeWeight: 2.0
                });


            }

        });
        //This for last line
        flightAllPath.push(flightPath);

        //draw Line
        for(var i = 0; i <= flightAllPath.length-1; i++){
            flightAllPath[i].setMap(map);
        }



    });

}



function station(route) {
    clearStation();
    var check = false;

    $.getJSON("/admin-transit/API/JSON/station/", function(jsonCM1) {

        $.each(jsonCM1, function(i, station1) {
            if(station1.type==route||route=="all"){
                // For Aj.Poon
                var icon = BS_special;

                var marker1 = new google.maps.Marker({
                    position: new google.maps.LatLng(station1.station_lat, station1.station_lng),
                    map: map,
                    title: station1.station_name,
                    icon: icon
                });

                var str = check_station(station1.station_name);
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

                array_station.push(marker1);
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

function check_station(station_name) {
    var array = [];
    var type;

    for (var i = 0; i <= json_station.length-1; i++) {

        if(json_station[i].station_name == station_name){

            array.push(json_station[i].type);
        }
    }
    type = array.join("-");
    return type;
}
function removeLine() {
    for(var i = 0; i <= flightAllPath.length-1; i++){
        flightAllPath[i].setMap(null);
    }

}
function clearStation() {
    for (var i = 0; i < array_station.length; i++) {
        array_station[i].setMap(null);
    }
    array_station = [];
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

        $('#rating'+i).html("ssss"+array_result[i].busstop);

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


function convert_car_detail(Detail) {
    var car_type = '';
    if(Detail=="R1"){
        car_type = "R1G";
    }
    if(Detail=="R2"||Detail=="สำรอง"){
        car_type = "R2P";
    }
    if(Detail=="R3-Y"){
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


function icon_off(){
    if(BS_special == '/admin-transit/image/icon_station/R3R_busstop.png'){
        BS_special = '/admin-transit/image/icon_station/point.png';
    }else{
        BS_special = '/admin-transit/image/icon_station/R3R_busstop.png'
    }
    check_station();
    array_marker = [];
    station(icon_current);
}

function stationClear(){


    setMapOnCar(null);
    clearStation();
    removeLine();
    array_marker = [];
    clearInterval(interval);
}