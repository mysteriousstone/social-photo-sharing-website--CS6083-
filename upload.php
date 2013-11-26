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
echo "<a href=\"getdistance.php\">Distance Calculator</a>";
echo '<br/>';



//create new message
echo '<br/>'."<a href=\"madd.php?uname=".$uname."\">Click to post message</a>";

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

$uname=$_SESSION['uname'];
$_SESSION['authorityphoto']=$_POST['authority'];
$authority=$_SESSION['authorityphoto'];

$uname=$_SESSION['uname'];

$time= date("20y-m-d : H:i:s", time());

$con = mysql_connect("localhost","web","lishi0");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("project", $con);


$name = $_FILES['myfile']['name'];
$type = $_FILES['myfile']['type'];
$tmp_name= $_FILES['myfile']['tmp_name'];
$error = $_FILES['myfile']['error'];
if($name)
{
if($_POST['submit'])
{


// get the file attribute

$image_size = getimagesize($_FILES['myfile']['tmp_name']);
if($image_size==false)
  { echo "That is not an image";
    echo "<br>";
    echo "<a href ='mypage.php?uname=$uname'>click</a>"." here_to_go _back ";  
  }
   
else
{
    if($name)
	{
	// star upload process
	echo $src = "uploaded/$name";
	move_uploaded_file($tmp_name,$src);
	
	$query = mysql_query("INSERT INTO photo (uname, ptime, pauthority, pname, psrc) values('$uname','$time','$authority','$name','$src')");
	
	
	
	
	$pid= mysql_insert_id();
	$_SESSION['pid']=$pid;
	$query = mysql_query("select * from photo where pid=$pid");

    $row = mysql_fetch_array($query);
	print mysql_error();
    $src = $row[6];

     echo "<img src='$src' width ='250' height='250'>";
	 echo "<br/>"."Upload Completed."."<br/>";
     echo "<a href='mypage.php?uname=$uname'>Back to MyPage</a>"	 ;
	
	}
	else
	  die("please select a file");

}

}
}
else 
{
  echo ("please select a file");
  echo "<br>";
  echo "<a href ='mypage.php?uname=$uname'>click</a>"." here_to_go _back ";

}

?>
<br>


<html>