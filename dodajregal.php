<?php
session_start();
include 'conn.php';

    $korisnik = $_SESSION["username"];
    echo $korisnik;

if (isset($_POST['dodaj'])) {
    $skladiste=$_POST['skladiste'];
    $regal_red=$_POST['regal_red'];
    $kolona_regal=$_POST['regal_kolona'];
    $regal_polje=$_POST['regal_polje'];
    $regal_polje_kolona=$_POST['regal_polje_kolona'];
    $lokacija = 'Hala';
    $kapacitet = $_POST['kapacitet'];
    $slobodno = $_POST['kapacitet'];

    $kolona_regal=(string)$kolona_regal;
    $kolona_regal=mb_strtoupper($kolona_regal, 'UTF-8');
        $sql = "INSERT INTO regali (skladiste,regal_red,regal_kolona,regal_polje,regal_polje_kolona,lokacija,kapacitet,slobodno) VALUES ('$skladiste','$regal_red','$kolona_regal','$regal_polje','$regal_polje_kolona','$lokacija','$kapacitet','$slobodno')";

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $sql_other_table = "INSERT INTO historija (korisnik, akcija, id_regala) VALUES ('$korisnik', 'Dodavanje regala $last_id', '$last_id')";
        if ($conn->query($sql_other_table) !== TRUE) {
            echo "Error: " . $sql_other_table . "<br>" . $conn->error;
        }

        $code = $last_id;

        file_put_contents('C:\xampp\htdocs\dio\barcode\python\printRegal\outputKod.txt', $code);
        file_put_contents('C:\xampp\htdocs\dio\barcode\python\printRegal\outputTekst.txt', $skladiste . "-" . $regal_red . "-" . $kolona_regal . "-" . $regal_polje . "/" . $regal_polje_kolona);
        sleep(2);
        $printer = "192.168.0.195";
    
        $command = 'python C:\xampp\htdocs\dio\barcode\python\printRegal\print.py';

        exec($command);
    
    header("Location: regal.php");
}
    
?>
