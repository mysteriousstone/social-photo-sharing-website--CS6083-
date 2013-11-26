<html>
<body>
<?php
session_start();
$uname=$_SESSION['uname'];
$con = mysql_connect("localhost","web","lishi0");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("project", $con);

$term = $_GET['uname'];

//Welcome
echo  "<TR BGcolorr=#00FFFF>"."Welcome to ".$term."'s Page";


//Head


echo "     ";
echo "<a href=\"mypage.php?uname=".$term."\">My Page</a>";
echo '<br/>';
echo '<hr/>';
?>
<table border="0" width="100%" cellpadding="10">
<tr>

<td width="25%" valign="top">
<?php
//Browse
echo "<a href=\"message.php?uname=".$term."\">Message</a>";
echo '<br/>';
echo "<a href=\"photo.php?uname=".$term."\">Photo</a>";
echo '<br/>';
echo "<a href=\"friendlist.php?uname=".$term."\">friendlist</a>";
echo '<br/>';
echo "<a href=\"circle.php?uname=".$term."\">Circle</a>";
echo '<br/>';
echo "<a href=\"location.php?uname=".$term."\">Location</a>";
echo '<br/>';
echo "<a href=\"getdistance.php\">Distance Calculator</a>";
echo '<br/>';



//create new message
echo "<br/>"."<a href=\"madd.php?uname=".$term."\">Click to post message</a>";

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
echo "<p style=\"font-family:verdana;font-size:100%;color:black\">"."My Friends"."<br/>";
echo "<p style=\"font-family:verdana;font-size:80%;color:black\">";
$sql=mysql_query("SELECT friendd FROM friendship WHERE userr='$uname' and status='approved'");
while($row=mysql_fetch_array($sql))
{
echo "<p style=\"font-family:verdana;font-size:80%;color:CC0066\">"."&nbsp"."&nbsp".$row[0]."<br/>";
echo "<p style=\"font-family:verdana;font-size:80%;color:black\">"."Circle: "."&nbsp"."&nbsp";
$sql2=mysql_query("SELECT cname FROM friend_circle
WHERE
friendname='$row[0]' and
username='$uname'");
while($row2=mysql_fetch_array($sql2))
{
echo $row2[0]."&nbsp"."&nbsp";
}
echo "<br/>";
echo "<a href=\"cdele.php?fname=".$row[0]."\">Delete Circle</a>"."&nbsp"."&nbsp";
echo "<a href=\"cadd.php?fname=".$row[0]."\">Add Circle</a>"."<br/>";
/*echo "Delete From Circle: ";
$in=mysql_query("select distinct cname from friend_circle where friendname='$row[0]' and username='$uname'");
echo "<select name='in'>";
while($inn=mysql_fetch_array($in))
{
$a[]=$inn[0];
}
$count=mysql_query("select count(*) from friend_circle where friendname='$row[0]' and username='$uname'and status='approved'");//("select count(*) from circle, friend_circle where uname='$uname' and username='$uname' and friendname='$row[0]'");
while($ro=mysql_fetch_array($count))
{
$N=$ro[0];
}
for($i=0;$i<$N;$i++)
{
echo "<option name='$i' value='$a[$i]'>".$a[$i]."</option>";
} 
echo "</select>";*/
echo "<a href='friend.php?fname=".$row[0]."'>View Friend</a>"."&nbsp"."&nbsp"."<br/>";
echo "<br/>";
echo "<br/>";
}
$sql3=mysql_query("SELECT userr FROM friendship WHERE friendd='$uname' and status='approved'");
while($row3=mysql_fetch_array($sql3))
{
echo "<p style=\"font-family:verdana;font-size:80%;color:CC0066\">"."&nbsp"."&nbsp".$row3[0]."<br/>";
echo "<p style=\"font-family:verdana;font-size:80%;color:black\">"."Circle: "."&nbsp"."&nbsp";
$sql4=mysql_query("SELECT cname FROM friend_circle
WHERE
friendname='$row[0]' and
username='$uname'");
while($row4=mysql_fetch_array($sql4))
{
echo $row4[0]."&nbsp"."&nbsp";
}
echo "<br/>";
echo "<a href=\"cdele.php?fname=".$row3[0]."\">Delete Circle</a>"."&nbsp"."&nbsp";
echo "<a href=\"cadd.php?fname=".$row3[0]."\">Add Circle</a>"."<br/>";
echo "<a href='friend.php?fname=".$row3[0]."'>View Friend</a>"."&nbsp"."&nbsp"."<br/>";
echo "<br/>";
echo "<br/>";
}
echo "<p style=\"font-family:verdana;font-size:100%;color:black\">"."Friends request"."<br/>";
echo "<p style=\"font-family:verdana;font-size:80%;color:black\">";
$sql5=mysql_query("SELECT userr FROM friendship WHERE friendd='$uname' and status='suspend'");
while($row5=mysql_fetch_array($sql5))
{
echo "<p style=\"font-family:verdana;font-size:80%;color:CC0066\">"."&nbsp"."&nbsp".$row5[0]."<br/>";
echo "<a href=\"refriend.php?rfname=".$row5[0]."\">Accept Request</a>"."&nbsp"."&nbsp";
echo "<a href=\"igfriend.php?rfname=".$row5[0]."\">Refuse Request</a>"."&nbsp"."&nbsp";
echo "<br/>";
}
?>