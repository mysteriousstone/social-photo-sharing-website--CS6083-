<?php
session_start();
$uname=$_SESSION['uname'];
$sf=$_POST['sf'];

$con = mysql_connect("localhost","web","lishi0");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("project", $con);

$term = $_GET['uname'];

//Welcome
echo "Welcome to ".$term."'s Page";


//Head


echo "     ";
echo "<a href=\"mypage.php?uname=".$term."\">My Page</a>";
echo '<br/>';
echo '<hr/>';

//Browse
echo "<a href=\"message.php?uname=".$term."\">Message</a>";
echo '<br/>';
echo "<a href=\"photo.php?uname=".$term."\">Photo</a>";
echo '<br/>';
echo "<a href=\"friendlist.php?uname=".$term."\">friendlist</a>";
echo '<br/>';
echo "<a href=\"circle.php?uname=".$term."\">Circle</a>";
echo '<br/>';

//search resault
$result = mysql_query("SELECT friendd, frid FROM friendship WHERE userr='$uname' and  friendd like '%$sf%' and status='approved'" );
echo '<br/>'."My Friends:".'<br/>'.'<br/>';
while($row = mysql_fetch_array($result))
  {
  echo $row[0].'<br/>'."<a href='friend.php?fname=".$row[0]."'>View Friend</a>".'<br/>'."  "."<a href='delef.php?frid=".$row[1]."'>Delete Friend</a>".'<br/>';
  echo "<br />";
  }

$result1 = mysql_query("SELECT friendd, frid FROM friendship WHERE userr='$uname' and  friendd like '%$sf%' and status='suspend'" );
echo '<br/>'."Suspend Requests:".'<br/>'.'<br/>';
while($row1 = mysql_fetch_array($result1))
  {
  echo $row1[0].'<br/>'."<a href='friend.php?fname=".$row1[0]."'>View Friend</a>".'<br/>'."  "."<a href='delef.php?frid=".$row1[1]."'>Delete Friend</a>".'<br/>';
  echo "<br />"."<a href='alterf.php?frid=".$row1[1]."'>Add Friend</a>".'<br/>';
  }

$result2 = mysql_query("SELECT name from username WHERE name like '%$sf%' and name not in (select friendd from friendship where userr='$uname')" );
echo '<br/>'."Strengers:".'<br/>'.'<br/>';
while($row2 = mysql_fetch_array($result2))
  {
  echo $row2[0].'<br/>'."<a href='friend.php?fname=".$row2[0]."'>View Friend</a>".'<br/>'."<a href='addf.php?fname=".$row2[0]."'>Add Friend</a>".'<br/>';
  }

mysql_close($con);

?>