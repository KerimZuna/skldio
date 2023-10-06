<?php
session_start();

$korisnik = $_SESSION["username"];

if (isset($_POST['generate'])) {
    $code = $_POST['barcode'];
    file_put_contents('C:\xampp\htdocs\dio\barcode\python\print\output.txt', $code);
    $printer = "192.168.0.195";
    $command = 'python C:\xampp\htdocs\dio\barcode\python\print\printaj.py';

    exec($command);

    $sql_other_table = "INSERT INTO historija (korisnik, akcija) VALUES ('$korisnik', 'Printanje koda: $code')";
            if ($conn->query($sql_other_table) !== TRUE) {
                echo "Error: " . $sql_other_table . "<br>" . $conn->error;        
            }
    header("Location: index.php");
    }

    header("Location: index.php");
?>
