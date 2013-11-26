<?php
session_start();
$uname=$_SESSION['uname'];
$term = $_GET['uname'];
echo "Add New Message:"."<form action=\"newmessage.php?uname=".$term."\" method=\"post\">
<input type=\"text\" name=\"nm\"><input type=\"submit\" name=\"add\" value=\"add\">
<form/>"."<br/>";
?>	   
	    <td>
        Authority:
		</td>
		<td>
		
		<?php		
		$con = mysql_connect("localhost","web","lishi0");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("project", $con);
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
echo "</select>";
?>
       
        </td>
