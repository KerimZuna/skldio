<<<<<<< HEAD
<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$db_name = "dio";

$conn = mysqli_connect($servername, $username, $password, "$db_name");

if (!$conn) {
  die('Could not Connect MySql Server:' . mysql_error());
}
=======
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
>>>>>>> 0ce7764a707c14f33bc28774473029c971784320
?>