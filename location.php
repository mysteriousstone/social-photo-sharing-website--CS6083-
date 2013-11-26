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
echo "<p style=\"font-family:verdana;font-size:100%;color:black\">"."My Location"."<br/>";
echo "<p style=\"font-family:verdana;font-size:80%;color:black\">";
$sql5=mysql_query("SELECT c.city,l.lloc,l.ltime from city as c,location as l where c.loc=l.lloc and l.uname='$uname'");
while($row5=mysql_fetch_array($sql5))
{
echo "<p style=\"font-family:verdana;font-size:80%;color:CC0066\">"."&nbsp"."&nbsp".$row5[0]."&nbsp";
echo "<p style=\"font-family:verdana;font-size:80%;color:CC0066\">"."&nbsp"."&nbsp".$row5[1]."&nbsp";
echo "<p style=\"font-family:verdana;font-size:80%;color:CC0066\">"."&nbsp"."&nbsp".$row5[2]."<br/>";

}

//
echo "Create location:"."<form action=\"createlocation.php?uname=".$term."\" method=\"post\">
<input type=\"text\" name=\"nc\"><input type=\"submit\" name=\"create\" value=\"create\">
<form/>"."<br/>";



?>