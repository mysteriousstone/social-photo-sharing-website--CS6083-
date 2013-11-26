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

//show past message
echo '<br/>';
$me=mysql_query("SELECT text, uname, mtime, mloc, meid FROM message WHERE uname='$term' ORDER BY mtime DESC");
echo "<p style=\"font-family:verdana;font-size:100%;color:black\">"."My Message".'<br/>'.'<br/>';
print mysql_error();
while($row2=mysql_fetch_array($me))
{
 echo "<p style=\"font-family:verdana;font-size:80%;color:black\">".$row2[0]."<br/>"."<br/>"."<p style=\"font-family:verdana;font-size:80%;color:CC0066\">".$row2[1]."&nbsp"."&nbsp"."&nbsp"."&nbsp"."<p style=\"font-family:verdana;font-size:80%;color:9999CC\">".$row2[2]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row2[3]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row2[4];

echo '<br/>'."Comments".'<br/>';
$mc=mysql_query("SELECT mcomments.text, postby, cmid, mcomments.meid from mcomments, message WHERE mcomments.meid=message.meid");
print mysql_error();while($row3=mysql_fetch_array($mc))

{
echo $row3[0]."&nbsp"."&nbsp".$row3[1]."&nbsp"."&nbsp"."<a href=\"addmc.php?cmid=".$row3[2]."\">"."<p style=\"font-family:verdana;font-size:60%;color:black\">Delete comment</a>".'<br/>';
}
echo "<a href=\"addmc.php?meid=".$row2[4]."\">"."<p style=\"font-family:verdana;font-size:60%;color:black\">Add comment</a>";
 echo   "&nbsp"."&nbsp"."<a href=\"mdelete.php?meid=".$row2[4]."\">"."<p style=\"font-family:verdana;font-size:60%;color:black\">DELETE</a>";

   echo "<br/>";
   echo "<br/>"; 

}
print mysql_error();
mysql_close($con);

?>

<body>
<html>