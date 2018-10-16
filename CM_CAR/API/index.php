<?php
$url = 'http://183.90.168.61/cmcar/';
$data = file_get_contents($url);
$characters = json_decode($data);


$new_array = array();

foreach ($characters as $character) {
    if($character->Type=="minibus"||$character->Type=="bus"||$character->Type=="kwvan"){
        $character->datetime_busstop = 99999;
        array_push($new_array,$character);
    }

}
//var_dump($new_array);

echo json_encode($new_array);

//
//<!--<script>-->
//<!--    var json_car = (function () {-->
//<!--        var json_car = null;-->
//<!--        $.ajax({-->
//<!--            'async': false,-->
//<!--            'global': false,-->
//<!--            'url': "/admin-transit/API",-->
//<!--            'dataType': "json",-->
//<!--            'success': function (data) {-->
//<!--                json_car = data;-->
//<!--            }-->
//<!--        });-->
//<!--        return json_car;-->
//<!--    })();-->
//<!---->
//<!--    console.log(json_car);-->
//<!--</script>-->
