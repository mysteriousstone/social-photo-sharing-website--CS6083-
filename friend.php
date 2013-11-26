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
<?
$fname=$_GET['fname'];
echo "Welcome to ".$fname."'s Page";

echo '<br/>';


//photo
   echo "<br/>";
   echo "<br/>"; 
   ?>
   <table border="0" width="75%" cellpadding="10">
<tr>

<td width="30%" valign="top">
<?php
   echo $fname."'s Photo";
   $ph=mysql_query("SELECT psrc, ptime, ploc, pname FROM photo where uname='$fname' and pauthority='public'");
   while($rph=mysql_fetch_array($ph))
  { 
     echo "<br/>";
   echo "<br/>"; 
  $src=$rph[0];
  echo "<img src='$src' width ='250' height='250'>"."<br/>".$rph[1]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$rph[2]."<br/>".$rph[3];
     echo "<br/>";
   echo "<br/>"; 
}


   echo "<br/>";
   echo "<br/>"; 
   $ph1=mysql_query("SELECT psrc,ptime,ploc,pname FROM photo as p, friendship,friend_circle as fc where p.uname='$fname'and userr=p.uname and friendd='$uname' and pauthority=fc.cname and fc.username=p.uname and fc.friendname='$uname'and status='Approved'");
   while($rph1=mysql_fetch_array($ph1))
  { 
     echo "<br/>";
   echo "<br/>"; 
  $src=$rph1[0];
  echo "<img src='$src' width ='250' height='250'>"."<br/>".$rph1[1]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$rph1[2]."<br/>".$rph1[3];
     echo "<br/>";
   echo "<br/>"; 
}

  echo "<br/>";
  echo "<br/>"; 
   $ph3=mysql_query("SELECT psrc,ptime,ploc,pname FROM photo as p, friendship,friend_circle as fc where p.uname='$fname'and friendd=p.uname and userr='$uname' and pauthority=fc.cname and fc.username=p.uname and fc.friendname='$uname'and status='Approved'");
   while($rph3=mysql_fetch_array($ph3))
  { 
     echo "<br/>";
   echo "<br/>"; 
  $src=$rph3[0];
  echo "<img src='$src' width ='250' height='250'>"."<br/>".$rph3[1]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$rph3[2]."<br/>".$rph3[3];
     echo "<br/>";
   echo "<br/>"; 
}
   echo "<br/>";
   echo "<br/>"; 




/*$ph=mysql_query("select * from message");print mysql_error();//select psrc, ptime, ploc, pid from photo where uname='$fname' and pauthority='public'
while($r=mysql_fetch_array($ph))
print mysql_error();
{
   echo "<br/>";
   echo "<br/>"; 
 //$src=$row[0];
echo "<img src='$src' width ='250' height='250'>"."<br/>".$row[1]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row[2]."<br/>".$row[3];
   echo "<br/>";
   echo "<br/>"; 

}
$sql2=mysql_query("select psrc, ptime, ploc pname from photo, friendship where uname='$fname' and pauthority='friend' and friendd in (select friendd from friendship where userr='$fname') and userr=uname");
print mysql_error();
while($row2=mysql_fetch_array($sql2))
print mysql_error();
{
   echo "<br/>";
   echo "<br/>"; 
 $src=$row2[0];
echo "<img src='$src' width ='250' height='250'>"."<br/>".$row2[1]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row2[2]."<br/>".$row2[3];
   echo "<br/>";
   echo "<br/>"; 

}

$sql3=mysql_query("select psrc, ptime, ploc, pname from photo, friendship, friend_circle
where photo.uname='$fname' and friend_circle.username='$fname' and
friendship.friendd in (select friendd from friendship where userr='$fname') and
friend_circle.friendname in (select friendname from friend_circle, photo where photo.pauthority=friend_circle.cname)");

print mysql_error();
while($row3=mysql_fetch_array($sql3))
print mysql_error();
{
   echo "<br/>";
   echo "<br/>"; 
 $src=$row3[0];
echo "<img src='$src' width ='250' height='250'>"."<br/>".$row3[1]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row3[2]."<br/>".$row3[3];
   echo "<br/>";
   echo "<br/>"; 

}*/


?>

<td width="40%" valign="top">
<?
 //Message
   echo $fname."'s Message";
    echo "<br/>";
   echo "<br/>"; 
$me=mysql_query("select text, mtime, mloc, meid from message where uname='$fname' and mauthority='public'");print mysql_error();
while($row=mysql_fetch_array($me))
{
   echo $row[0]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row[1]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row[2]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row[3];
   echo "<br/>";
   echo "<br/>";
   echo "<br/>";
   echo "<br/>"; 
}
   $me2=mysql_query("SELECT text, mtime, mloc, meid FROM message as m, friendship,friend_circle as fc where m.uname='$fname'and userr=m.uname and friendd='$uname' and mauthority=fc.cname and fc.username=m.uname and fc.friendname='$uname'and status='Approved'");
   while($row2=mysql_fetch_array($me2))
  { 
    echo $row2[0]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row2[1]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row2[2]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row2[3];
   echo "<br/>";
   echo "<br/>";
   echo "<br/>";
   echo "<br/>"; 
}

  echo "<br/>";
  echo "<br/>"; 
   $me3=mysql_query("SELECT text, mtime, mloc, meid FROM message as m, friendship,friend_circle as fc where m.uname='$fname'and friendd=m.uname and userr='$uname' and mauthority=fc.cname and fc.username=m.uname and fc.friendname='$uname'and status='Approved'");
   while($row3=mysql_fetch_array($me3))
  { 
     echo $row3[0]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row3[1]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row3[2]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$row3[3];
   echo "<br/>";
   echo "<br/>";
   echo "<br/>";
   echo "<br/>";
}
   echo "<br/>";
   echo "<br/>"; 
?>

<td width="50%" valign="top">
<?
//location
   echo $fname."'s location";
    echo "<br/>";
   echo "<br/>"; 

$lo1=mysql_query("select c.city,l.lloc,l.ltime from city as c, location as l where c.loc=l.lloc and l.uname='$fname' and loauthority='public'");print mysql_error();
while($rowl1=mysql_fetch_array($lo1))
{
   echo $rowl1[0]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$rowl1[1]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$rowl1[2];
   echo "<br/>";
   echo "<br/>";
   echo "<br/>";
   echo "<br/>"; 
}
$lo2=mysql_query("SELECT distinct
    c.city, l.lloc, l.ltime
from
    city as c,
    location as l,
    friendship,
    friend_circle as fc
where
    c.loc = l.lloc and friendd = fc.username and friendd= l.uname and l.uname= '$fname' and fc.friendname = userr and userr= '$uname' and loauthority = fc.cname and status = 'Approved'
");print mysql_error();
while($rowl2=mysql_fetch_array($lo2))
{ 
   echo $rowl2[0]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$rowl2[1]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$rowl2[2];
   echo "<br/>";
   echo "<br/>";
   echo "<br/>";
   echo "<br/>"; 
}

  echo "<br/>";
  echo "<br/>"; 
   $lo3=mysql_query("SELECT c.city,l.lloc,l.ltime from city as c,location as l, friendship,friend_circle as fc where c.loc=l.lloc and l.uname='$fname'and userr=l.uname and friendd='$uname' and loauthority=fc.cname and fc.username='$fname' and fc.friendname='$uname' and status='Approved'");print mysql_error();
   while($rowl3=mysql_fetch_array($lo3))
  { 
     echo $rowl3[0]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$rowl3[1]."&nbsp"."&nbsp"."&nbsp"."&nbsp".$rowl3[2];
   echo "<br/>";
   echo "<br/>";
   echo "<br/>";
   echo "<br/>";
}
   echo "<br/>";
   echo "<br/>"; 
   
?>