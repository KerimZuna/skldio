<?php
include 'conn.php';

if (isset($_POST['dodaj']) && isset($_POST['broj'])) {
    $broj = $_POST['broj'];
    $lokacija = 'Garaža';
    $kapacitet = $_POST['kapacitet'];
    for ($i = 1; $i <= $broj; $i++) {
        $sql = "INSERT INTO kutije (lokacija, kapacitet, slobodno) VALUES ('$lokacija','$kapacitet','$kapacitet')";

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            break;
        }

        $code = $last_id;

        file_put_contents('C:\xampp\htdocs\dio\barcode\python\print\output.txt', $code);
        sleep(2);
        $printer = "192.168.0.195";

        $command = 'python C:\xampp\htdocs\dio\barcode\python\print\print.py';

        exec($command);
    }
    header("Location: kutija.php");
}

?>