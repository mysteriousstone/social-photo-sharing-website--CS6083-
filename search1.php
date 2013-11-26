<?php
session_start();
$uname=$_SESSION['uname'];
echo "<br/>"."<br/>"."<br/>"."Search"."<form action=search.php?uname=$uname method='post'><select name='object'><option name='one' value='friend'>friend</option> 
                                     <option name='two' value='message'>message</option>
	                                 <option name='three'value='photo'>photo</option>
               </select><input type='text' name='text'><input type='submit' value='search'>";
?>