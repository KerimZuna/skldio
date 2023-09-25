<?php 
session_start();
include "../../conn.php";

$korisnik = $_SESSION["username"];
if (isset($_POST['generate'])) {
$id_palete = $_POST['id_palete'];
$lokacija = $_POST['lokacija'];
$query = "SELECT * FROM palete WHERE paleta_id = '$id_palete'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
$sql_kutije = "UPDATE palete SET lokacija = '$lokacija' WHERE paleta_id = '$id_palete'";
if ($conn->query($sql_kutije) !== TRUE) {
    echo "Error: " . $sql_kutije . "<br>" . $conn->error;
}

$sql_artikli = "UPDATE artikli SET lokacija = '$lokacija' WHERE id_palete = '$id_palete'";
if ($conn->query($sql_artikli) !== TRUE) {
    echo "Error: " . $sql_artikli . "<br>" . $conn->error;
}

$sql_other_table = "INSERT INTO historija (korisnik, akcija, id_palete) VALUES ('$korisnik', 'Promjena lokacije palete $id_palete na $lokacija', '$id_palete')";
        if ($conn->query($sql_other_table) !== TRUE) {
            echo "Error: " . $sql_other_table . "<br>" . $conn->error;
        }

header("Location: ../paletalokacija.php?message=Uspjesno+promjenjena+lokacija+palete+$id_palete");
} else {
    header("Location: ../paletalokacija.php?message=Nema+palete+$id_palete");
 }
}
?>