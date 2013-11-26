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

//recent photo
$ph=mysql_query("SELECT psrc, pid, ptime, ploc, pauthority, pname FROM photo WHERE uname='$term' ORDER BY ptime DESC limit 5");
print mysql_error();
echo "<p style=\"font-family:verdana;font-size:100%;color:black\">"."Recent Photo".'<br/>';
while($row1=mysql_fetch_array($ph))
{
   $src=$row1[0];
   echo "<img src='$src' width ='250' height='250'>"."<br/>"."<p style=\"font-family:verdana;font-size:80%;color:CC0066\">".
   $row1[5]."&nbsp"."&nbsp"."&nbsp"."&nbsp"."<p style=\"font-family:verdana;font-size:80%;color:9999CC\">".$row1[2]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row1[3]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row1[4];
   echo "<br/>";
   echo "<br/>"; 
}
?>

</td>
<td width="" valign="top">
<?php
//recent message
$me=mysql_query("SELECT text, uname, mtime, mloc, mauthority FROM message WHERE uname='$term' ORDER BY mtime DESC");
echo "<p style=\"font-family:verdana;font-size:100%;color:black\">"."Recent Message".'<br/>'.'<br/>';
print mysql_error();
while($row2=mysql_fetch_array($me))
{
   echo "<p style=\"font-family:verdana;font-size:80%;color:black\">".$row2[0]."<br/>"."<br/>"."<p style=\"font-family:verdana;font-size:80%;color:CC0066\">".$row2[1]."&nbsp"."&nbsp"."&nbsp"."&nbsp"."<p style=\"font-family:verdana;font-size:80%;color:9999CC\">".$row2[2]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row2[3]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row2[4];
   echo "<br/>";
   echo "<br/>"; 
}
?>
</td>

</tr>
</table>
<body>
<html>
