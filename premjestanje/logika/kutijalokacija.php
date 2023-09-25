<?php 
session_start();
include "../../conn.php";

$korisnik = $_SESSION["username"];
if (isset($_POST['generate'])) {
$id_kutije = $_POST['id_kutije'];
$lokacija = $_POST['lokacija'];
$query = "SELECT * FROM kutije WHERE kutija_id = $id_kutije;";
$result = $conn->query($query);

if ($result->num_rows > 0) {
$sql_kutije = "UPDATE kutije SET lokacija = '$lokacija' WHERE kutija_id = '$id_kutije'";
if ($conn->query($sql_kutije) !== TRUE) {
    echo "Error: " . $sql_kutije . "<br>" . $conn->error;
}

$sql_artikli = "UPDATE artikli SET lokacija = '$lokacija' WHERE id_kutije = '$id_kutije'";
if ($conn->query($sql_artikli) !== TRUE) {
    echo "Error: " . $sql_artikli . "<br>" . $conn->error;
}

$sql_other_table = "INSERT INTO historija (korisnik, akcija, id_kutije) VALUES ('$korisnik', 'Promjena lokacije kutije $id_kutije na $lokacija', '$id_kutije')";
        if ($conn->query($sql_other_table) !== TRUE) {
            echo "Error: " . $sql_other_table . "<br>" . $conn->error;
        }

header("Location: ../kutijalokacija.php?message=Uspjesno+promjenjena+lokacija+kutije+$id_kutije");
} else {
    header("Location: ../kutijalokacija.php?message=Nema+kutije+$id_kutije");
 }
}
?>