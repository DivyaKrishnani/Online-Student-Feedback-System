<?php
$servername = "localhost";
$username = "root";
$password = "";
$db= "sfs";
$db_handle = mysql_connect($servername, $username, $password,$db);
$db_found = mysql_select_db($db, $db_handle);


if (!$db_found) {
	die("DATABASE not found!");
}

?>
