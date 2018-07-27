<!DOCTYPE html>
<html>
<head>
   <title>Driver Info</title>
   <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
   <?php
      //$id = $_REQUEST['id'];
      function create_vote($id) {
         $form = '

         <form action="vote.php" method="post">
         <input type="hidden" name="driver" value="' . $id . '">
         <div class="span2 center form-group">
            <div class="radio">
               <label><input type="radio" name="vote" value="1">ควรปรับปรุง</label>
            </div>
            <div class="radio">
               <label><input type="radio" name="vote" value="2">แย่</label>
            </div>
            <div class="radio">
               <label><input type="radio" name="vote" value="3">พอใช้</label>
            </div>
            <div class="radio">
               <label><input type="radio" name="vote" value="4">ดี</label>
            </div>
            <div class="radio">
               <label><input type="radio" name="vote" value="5">ดีมาก</label>
            </div>
         </div>
         <div class="form-group">
            <textarea type="comment" class="span12" name="comment" placeholder="* Comments..."></textarea>
         </div>
         <div class="form-group">
            <input class="btn btn-primary" type="submit">
         </div>
         </form>
         ';
         return $form;
      }
   ?>

</body>
</html>


