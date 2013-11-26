<?php
session_start();
$uname=$_SESSION['uname'];
$term = $_GET['uname'];
echo "     ";
echo "<a href=\"mypage.php?uname=".$uname."\">My Page</a>";
echo '<br/>';
echo '<hr/>';


//mysql connect
$con = mysql_connect("localhost","web","lishi0");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("project", $con);
echo "<p style=\"font-family:verdana;font-size:100%;color:black\">"."My Circle"."<br/>";
echo "<p style=\"font-family:verdana;font-size:80%;color:black\">";
$sql5=mysql_query("SELECT distinct cname FROM circle WHERE uname='$uname'");
while($row5=mysql_fetch_array($sql5))
{
echo "<p style=\"font-family:verdana;font-size:80%;color:CC0066\">"."&nbsp"."&nbsp".$row5[0]."<br/>";
echo "<br/>";
}

//
echo "Create Circle:"."<form action=\"createcircle.php?uname=".$term."\" method=\"post\">
<input type=\"text\" name=\"nc\"><input type=\"submit\" name=\"create\" value=\"create\">
<form/>"."<br/>";



?>