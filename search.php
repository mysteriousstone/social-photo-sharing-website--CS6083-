<?php
session_start();
$uname=$_SESSION['uname'];
$con = mysql_connect("localhost","web","lishi0");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("project", $con);



//Welcome
echo  "<TR BGcolorr=#00FFFF>"."Welcome to ".$uname."'s Page";


//Head


echo "     ";
echo "<a href=\"mypage.php?uname=".$uname."\">My Page</a>";
echo '<br/>';
echo '<hr/>';
?>
<table border="0" width="100%" cellpadding="10">
<tr>

<td width="25%" valign="top">
<?php
//Browse
echo "<a href=\"message.php?uname=".$uname."\">Message</a>";
echo '<br/>';
echo "<a href=\"photo.php?uname=".$uname."\">Photo</a>";
echo '<br/>';
echo "<a href=\"friendlist.php?uname=".$uname."\">friendlist</a>";
echo '<br/>';
echo "<a href=\"circle.php?uname=".$uname."\">Circle</a>";
echo '<br/>';
echo "<a href=\"location.php?uname=".$uname."\">Location</a>";
echo '<br/>';
echo "<a href=\"getdistance.php\">Distance Calculator</a>";
echo '<br/>';



//create new message
echo "<br/>"."<a href=\"madd.php?uname=".$uname."\">Click to post message</a>";

?>


</head>

<form method="POST" enctype="multipart/form-data" action="upload.php">
<table>
<tr> 
	    <td>
        Upload Photo:
		</td>
		<td>
		<input type="file" name="myfile">
		</td>


<br>
<tr> 
	    <td>
        Authority:
		</td>
		<td>
		
		<?php		
$circle=mysql_query("select cname from circle where uname='$uname'");
echo "<select name='authority'>";
while($row=mysql_fetch_array($circle))
{
$authority[]=$row[0];
}
$count=mysql_query("select count(*) from circle where uname='$uname'");
while($ro=mysql_fetch_array($count))
{
$N=$ro[0];
}
for($i=0;$i<$N;$i++)
{
echo "<option name='$i' value='$authority[$i]'>".$authority[$i]."</option>";
} 
echo "</select>"."<br/>";

?>
       
        </td>
</tr>
</table>
<br>
<input type="submit" name="submit" value="upload">

<br/><br/>
<a href="search1.php">Search</a>
</form>
</td>
<td width="37%" valign="top">


<?php
$ob=$_POST['object'];
$text=$_POST['text'];
$term = $uname;

if($ob=="friend")
{
//search resault
$result = mysql_query("SELECT friendd, frid FROM friendship WHERE userr='$uname' and  friendd like '%$text%' and status='approved'" );
echo '<br/>'."<p style=\"font-family:verdana;font-size:100%;color:black\">"."My Friends:".'<br/>'.'<br/>';
while($row = mysql_fetch_array($result))
  {
  echo "<p style=\"font-family:verdana;font-size:80%;color:CC0066\">".$row[0].'<br/>'."<a href='friend.php?fname=".$row[0]."'>View Friend</a>".'<br/>'."  "."<a href='delef.php?frid=".$row[1]."'>Delete Friend</a>".'<br/>';
  echo "<br />";
  }
$result3 = mysql_query("SELECT userr FROM friendship WHERE friendd='$uname' and  userr like '%$text%' and status='approved'" );

while($row3 = mysql_fetch_array($result3))
  {
  echo "<p style=\"font-family:verdana;font-size:80%;color:CC0066\">".$row3[0].'<br/>'."<a href='friend.php?fname=".$row3[0]."'>View Friend</a>".'<br/>'."  "."<a href='delef.php?frid=".$row[1]."'>Delete Friend</a>".'<br/>';
  echo "<br />";
  }

$result1 = mysql_query("SELECT userr FROM friendship WHERE friendd='$uname' and  userr like '%$text%' and status='suspend'" );
echo '<br/>'."<p style=\"font-family:verdana;font-size:100%;color:black\">"."Suspend Requests:".'<br/>'.'<br/>';
while($row1 = mysql_fetch_array($result1))
  {
  echo "<p style=\"font-family:verdana;font-size:80%;color:CC0066\">".$row1[0].'<br/>';
  echo "<a href=\"refriend.php?rfname=".$row1[0]."\">Accept Request</a>"."&nbsp"."&nbsp";
  echo "<a href=\"igfriend.php?rfname=".$row1[0]."\">Refuse Request</a>"."&nbsp"."&nbsp";  
  }

$result2 = mysql_query("SELECT name from username WHERE name like '%$text%' and name not in (select friendd from friendship where userr='$uname' union select userr from friendship where friendd = '$uname')" );
echo '<br/>'."<p style=\"font-family:verdana;font-size:100%;color:black\">"."Strangers:".'<br/>'.'<br/>';
while($row2 = mysql_fetch_array($result2))
  {
  echo "<p style=\"font-family:verdana;font-size:80%;color:CC0066\">".$row2[0].'<br/>'."<a href='friend.php?fname=".$row2[0]."'>View Friend</a>".'<br/>'."<a href='addf.php?fname=".$row2[0]."'>Add Friend</a>".'<br/>';
  }
mysql_close($con);

}
//message result
else if($ob=="message")
{
$sm=mysql_query("select text,uname,mtime,mloc from message where text like '%$text%' and mauthority ='public'");
while($row1=mysql_fetch_array($sm))
{ echo $row1[0]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row1[1]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row1[2]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row1[3];
   echo "<br/>";
   echo "<br/>";  
}

$sm1=mysql_query("SELECT text,m.uname,mtime,mloc FROM message as m, friendship,friend_circle as fc where text like '%$text%' and userr=m.uname and friendd='$uname' and mauthority=fc.cname and fc.username=m.uname and fc.friendname='$uname'and status='Approved'");
while($row2=mysql_fetch_array($sm1))
{ echo $row2[0]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row2[1]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row2[2]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row2[3];
   echo "<br/>";
   echo "<br/>";  
}
$sm3=mysql_query("SELECT text,m.uname,mtime,mloc FROM message as m, friendship,friend_circle as fc where text like '%$text%' and friendd=m.uname and userr='$uname' and mauthority=fc.cname and fc.username=m.uname and fc.friendname='$uname'and status='Approved'");
while($row3=mysql_fetch_array($sm3))
{ echo $row3[0]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row3[1]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row3[2]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row3[3];
   echo "<br/>";
   echo "<br/>";  
}
}
//photo result
else
{
$sp=mysql_query("SELECT psrc, pid, ptime, ploc, pname FROM photo WHERE pname like '%$text%'");
while($row1=mysql_fetch_array($sp))
{
   $src=$row1[0];
   echo "<img src='$src' width ='250' height='250'>"."<br/>".$row1[1]."&nbsp"."&nbsp"."&nbsp"."&nbsp".
   $row1[4]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row1[2]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row1[3]."<br/>";
   echo "<br/>";
}
}
?>