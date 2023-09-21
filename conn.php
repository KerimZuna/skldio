<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$db_name = "dio";

// Create connection
$conn = mysqli_connect($servername, $username, $password, "$db_name");

// Check connection
if(!$conn){
    die('Could not Connect MySql Server:' .mysql_error());
  }
?>