<?php
include_once 'conn.php';    
if (isset($_POST['submit'])) {
    $naziv = $_POST['naziv'];
    $kb = $_POST['kb'];
    $ABC = $_POST['ABC'];
    $marka = $_POST['marka'];
    $tip = $_POST['tip'];
    $kod_mjenjaca = $_POST['kod_mjenjaca'];
    $kod_broj_motora = $_POST['kod_broj_motora'];
    $mjenjac = $_POST['mjenjac'];
    $brzina = $_POST['brzina'];
    $strana = $_POST['strana'];
    $vrata = $_POST['vrata'];
    $grupa = $_POST['grupa'];
    $kw = $_POST['kw'];
    $ccm = $_POST['ccm'];
    $vozilo = $_POST['vozilo'];
    $paleta = $_POST['paleta'];
    $pozicija = $_POST['pozicija'];
    $cijena = $_POST['cijena'];
    $gorivo = $_POST['gorivo'];
    $opis = $_POST['opis'];
    $dobavljac = $_POST['dobavljac'];
    $sql = "INSERT INTO unos (Naziv, KB, AB, Marka, Kod_Mjenjaca, Kod_Broj_Motora, Mjenjac, Brzina, Strana, Vrata, Grupa, KW, ccm, Vozilo, Paleta, Pozicija, Cijena, Gorivo, Opis, Dobavljac)
            VALUES ('$naziv','$kb','$ABC','$marka','$tip','$kod_mjenjaca','$kod_broj_motora','$mjenjac','$brzina','$strana','$vrata','$grupa','$kw','$ccm','$vozilo','$paleta','$pozicija','$cijena','$gorivo','$opis','$dobavljac')";

    $stmt = mysqli_prepare($conn, $sql);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: unos.php");
    } else {
        echo "Error executing SQL statement: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

?>