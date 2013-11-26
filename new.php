<?php
$a=md5("aryw45y");
echo $a;
?>


<?php		
$circle=mysql_query("select cname from circle where uname='$uname'");

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
echo "<option name='$i' value='$authority[i]'>".$authority[$i]."</option>";
}
?>