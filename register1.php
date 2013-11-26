<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
$db_select=mysql_select_db("project", $con);
if(!$db_select)
{
 die("Can\'t use test_db :" . mysql_error());
}
$a=$_POST['uname'];
$p=md5($_POST['psw']);
$age=$_POST['age'];
$gender=$_POST['gender'];
$ucity=$_POST['ucity'];
$ustate=$_POST['ustate'];
$ucountry=$_POST['ucountry'];
$name=$_POST['name'];
if($a==""||$p=="")
{
      echo "Username and password can't be null."."<br/>"."<a href=\"register.php\">Try Again</a>";
    exit;
}
$result=mysql_query("SELECT uname FROM username WHERE uname='$a'");
$num = mysql_num_rows($result);

if($num)
{
 echo "This username has already been registered, please try again with another username.";
 echo "<br/>";
 echo "<a href=\"register.php\">Try Again</a>";
}

else
{
$insert="INSERT INTO username VALUES('$a','$age','$gender','$ucity','$ustate','$ucountry','$name','$p')";
mysql_query($insert);
$insert1="INSERT INTO circle VALUES ('public','$a')";
mysql_query($insert1);
$insert1="INSERT INTO circle VALUES ('friend','$a')";
mysql_query($insert1);
$insert1="INSERT INTO circle VALUES ('private','$a')";
mysql_query($insert1);
echo "Congratulations ".$a.", you have been successfully registered. Please login with your username and password and have fun";
echo "<br/>"."<a href=\"welcom.html\">Welcome";
}


mysql_close($con);
?>