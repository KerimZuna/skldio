<?php 
session_start();
include "conn.php";

$korisnik = $_SESSION["username"];
echo $korisnik;

if (isset($_POST['spremi'])) {
$id_dijela=$_POST['idDijela'];
$trazio = $_POST['trazio'];
$lokacija =$_POST['lokacija'];
$sql = "INSERT INTO izlazrobe (id_dijela,trazio,lokacija) VALUES ('$id_dijela','$trazio','$lokacija')";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $sql_other_table = "INSERT INTO historija (korisnik, akcija, id_dijela) VALUES ('$korisnik', 'Izlaz dijela: $id_dijela - $trazio - $lokacija', '$last_id')";
        if ($conn->query($sql_other_table) !== TRUE) {
            echo "Error: " . $sql_other_table . "<br>" . $conn->error;
        }

}
header("Location: izlazrobe.php");
?>