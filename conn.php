<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$db_name = "dio";

$conn = mysqli_connect($servername, $username, $password, "$db_name");

if (!$conn) {
  die('Could not Connect MySql Server:' . mysql_error());
}
?>