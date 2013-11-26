<html>
<body>
<?php
session_start();
$uname=$_SESSION['uname'];
$meid=$_GET['meid'];
echo "<form action=\"addmc1.php?meid=".$meid."\" method=\"POST\">".
"<input type=\"text\" name=\"text\">".
"<input type=\"submit\" name=\"submit\">".
"</form>";
?>
<body>
<html>