<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dio";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['korisnicko_ime'];
$password = $_POST['sifra'];
$sql = "SELECT ID FROM korisnici WHERE korisnicko_ime='$username' AND sifra='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION["user_id"] = $row["ID"];
    header("Location: index.php");
} else {
    echo "Neuspješan login. Provjerite korisničko ime ili šifru!";
}

$conn->close();
?>