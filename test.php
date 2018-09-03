<!DOCTYPE html>
<html>
<head>
    <title>CM-TRANSIT</title>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
</head>
<body>
<canvas id="canvas" width=300 height=300></canvas><br>
<button id="counterclockwise">Rotate left</button>
<button id="clockwise">Rotate right</button>

<script type="text/javascript">
    var canvas=document.getElementById("canvas");
    var ctx=canvas.getContext("2d");

    var angleInDegrees=0;

    var image=document.createElement("img");
    image.onload=function(){
        ctx.drawImage(image,canvas.width/2-image.width/2,canvas.height/2-image.width/2);
    }
    image.src="/admin-transit/image/icon_car/R3R.png";



    $("#clockwise").click(function(){
        angleInDegrees+=10;
        drawRotated(angleInDegrees);
    });

    $("#counterclockwise").click(function(){
        angleInDegrees-=10;
        drawRotated(angleInDegrees);

        $.ajax({
            type: 'POST',
            url: "test2.php",
            data: { anger: angleInDegrees,
                name: "R3R",
                image: canvas.toDataURL("image/png")}, //It would be best to put it like that, make it the same name so it wouldn't be confusing
            error: function() {
            alert('Something is wrong');
        },
            success: function(data){
                alert(data);
            },
        });
    });


    function drawRotated(degrees){
        ctx.clearRect(0,0,canvas.width,canvas.height);
        ctx.save();
        ctx.translate(canvas.width/2,canvas.height/2);
        ctx.rotate(degrees*Math.PI/180);
        ctx.drawImage(image,-image.width/2,-image.width/2);
        ctx.restore();


    };



</script>

</body>
</html>
