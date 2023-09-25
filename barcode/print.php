<?php

$printer = "192.168.0.110";

// Check if the file exists
// Construct the smbclient command to send the image to the printer
$command = 'python C:\xampp\htdocs\dio\barcode\python\print\print.py';

// Execute the command to send the image to the printer
exec($command); // This will show any output from the command
header("Location: index.php");
?>