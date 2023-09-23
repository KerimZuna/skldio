<?php 
session_start();
include "conn.php";

$korisnik = $_SESSION["username"];
echo $korisnik;

if (isset($_POST['spremi'])) {
$id_dijela=$_POST['idDijela'];
$trazio = $_POST['trazio'];
$lokacija =$_POST['lokacija'];

    $artikliquery = "SELECT id_kutije FROM artikli WHERE id_artikla = '$id_dijela'";
            $rezultat = $conn->query($artikliquery);
            $red = $rezultat->fetch_assoc();
            $kutija = $red['id_kutije'];
    if ($rezultat === false) {
        echo "Query error: " . $conn->error;
    } elseif ($rezultat->num_rows > 0) {


        $kutijaquery= "SELECT slobodno FROM kutije WHERE kutija_id = '$kutija'";
        $rez = $conn->query($kutijaquery);
        $row = $rez->fetch_assoc();
        $slobodno = $row['slobodno'];

$sql = "INSERT INTO izlazrobe (id_dijela,trazio,lokacija) VALUES ('$id_dijela','$trazio','$lokacija')";

    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql_other_table = "INSERT INTO historija (korisnik, akcija, id_dijela) VALUES ('$korisnik', 'Izlaz dijela: $id_dijela - $trazio - $lokacija', '$last_id')";
    if ($conn->query($sql_other_table) !== TRUE) {
        echo "Error: " . $sql_other_table . "<br>" . $conn->error;
    }

    $sql_delete = "DELETE FROM artikli WHERE id_artikla = '$id_dijela'";
    if ($conn->query($sql_delete) !== TRUE) {
        echo "Error: " . $sql_delete . "<br>" . $conn->error;
    }
    $slobodno++;
    $sql_update = "UPDATE kutije SET slobodno = $slobodno WHERE kutija_id = '$kutija'";
    if ($conn->query($sql_update) !== TRUE) {
        echo "Error: " . $sql_update . "<br>" . $conn->error;
    }


    header("Location: izlazrobe.php");
} else {
    header("Location: izlazrobe.php?message=Nema+dijela+sa+tim+ID");
}
}
?>