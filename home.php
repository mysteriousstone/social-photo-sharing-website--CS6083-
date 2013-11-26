<?php

session_start();
$a=$_GET['uname'];
$p=md5($_GET['psw']);
$_SESSION['uname'] = $a;
$con = mysql_connect("localhost","root","lishi0");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("project", $con);

$sql="select uname from username where uname='$a' and password='$p'";
$check=mysql_query($sql);
if($row=mysql_fetch_array($check))
{
  echo "Welcome ".$row[0]."     ";

echo "     ";
echo "<a href=\"mypage.php?uname=".$a."\">My Page</a>";
echo '<br/>';
echo '<hr/>';
echo "<a href=\"message.php?uname=".$a."\">Message</a>";
echo '<br/>';
echo "<a href=\"photo.php?uname=".$a."\">Photo</a>";
echo '<br/>';
echo "<a href=\"friendlist.php?uname=".$a."\">friendlist</a>";
echo '<br/>';
echo "<a href=\"circle.php?uname=".$a."\">Circle</a>";
echo '<br/>';
echo "<a href=\"location.php?uname=".$a."\">Location</a>";
echo '<br/>';
//message

$message="SELECT text, uname, mtime, mloc FROM message ORDER BY mtime DESC limit 5";
$resault=mysql_query($message);
 while($row1=mysql_fetch_array($resault))
  {
   echo $row1[0]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row1[1]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row1[2]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row1[3];
   echo "<br/>";
   echo "<br/>";
   print mysql_error();
  } 
  echo "Search Friend:"."<form action=\"sf.php?uname=".$a."\" method=\"post\">
<input type=\"text\" name=\"sf\"><input type=\"submit\" name=\"search\" value=\"search\">
<form/>"."<br/>";
echo "Search Message:"."<form action=\"sm.php?uname=".$a."\" method=\"post\">
<input type=\"text\" name=\"sm\"><input type=\"submit\" name=\"search\" value=\"search\">
<form/>"."<br/>";
echo "Search Photo:"."<form action=\"sp.php?uname=".$a."\" method=\"post\">
<input type=\"text\" name=\"sp\"><input type=\"submit\" name=\"search\" value=\"search\">
<form/>"."<br/>";
}
//photo

//else
//{
// echo "The username or password you just entered is wrong, please try again"."<br/>"."<a href=\"welcom.html\">Home";
//}
print mysql_error();
mysql_close($con);
?>