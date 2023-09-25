<?php
session_start();
include 'conn.php';

    $korisnik = $_SESSION["username"];
    echo $korisnik;
if (isset($_POST['dodaj']) && isset($_POST['broj'])) {
    $broj = $_POST['broj'];
    $lokacija = 'Garaža';
    $kapacitet = $_POST['kapacitet'];
    for ($i = 1; $i <= $broj; $i++) {
        $sql = "INSERT INTO palete (lokacija,kapacitet,slobodno) VALUES ('$lokacija','$kapacitet','$kapacitet')";

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            break; // Exit the loop if there's an error in one iteration
        }

        $sql_other_table = "INSERT INTO historija (korisnik, akcija, id_palete) VALUES ('$korisnik', 'Dodavanje palete $last_id', '$last_id')";
        if ($conn->query($sql_other_table) !== TRUE) {
            echo "Error: " . $sql_other_table . "<br>" . $conn->error;
            break; // Exit the loop if there's an error in one iteration
        }

        $code = $last_id;

        file_put_contents('C:\xampp\htdocs\dio\barcode\python\print\output.txt', $code);
        sleep(2);
        $printer = "192.168.0.195";
    
        $command = 'python C:\xampp\htdocs\dio\barcode\python\print\printaj.py';

        exec($command);
    }
    header("Location: paleta.php");
}
    
?>
