 <?php
mysql_connect("localhost","chiangmaibus","g=up'.s,j");
mysql_select_db("chiangmaibus");
mysql_query("set names utf8");

//$data = $_REQUEST['id'];
$driver=$_POST['id'];
$vote=$_POST['vote'];
$comment=trim($_POST['comment']);
mysql_query("insert into `driver_vote`(id,vote,comment) values($id, $vote,'$comment')");

echo "ให้คะแนนสำเร็จ";
?>
