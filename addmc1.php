<?php
session_start();
$uname=$_SESSION['uname'];
$text=$_POST['text'];
$meid=$_GET['meid'];
$con = mysql_connect("localhost","web","lishi0");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("project", $con);
$insert="insert into mcomments values('','$meid','$text','$uname')";
mysql_query($insert);
echo "Comment succesful, click to get back"
?>
