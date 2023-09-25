<?php
include_once '../../conn.php';

if (isset($_POST['premjesti'])) {
    $idPalete = $_POST['idPalete'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    foreach ($_POST['idKutije'] as $key => $idKutije) {
        $query = "SELECT lokacija FROM palete WHERE paleta_id = '$idPalete'";
        $result = $conn->query($query);

        if ($result === false) {
            echo "Query error: " . $conn->error;
        } elseif ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lokacija = $row['lokacija'];

            $sql = "INSERT INTO kutije (id_kutije, id_palete, lokacija)
            VALUES ('$idKutije', '$idPalete', '$lokacija')
            ON DUPLICATE KEY UPDATE
            id_palete = '$idPalete',
            lokacija = '$lokacija'";

            if ($conn->query($sql) === TRUE) {
                if ($conn->affected_rows > 0) {
                    header("Location: ../kutijapaleta.php?message=Uspješno+sačuvani+kutije+u+paletu+$idPalete");
                } else {
                    echo "Nisu napravljene promjene za ID: $idKutije";
                    header("Location: ../kutijapaleta.php");
                }
            } else {
                echo "Greška pri ažuriranju/umetanju zapisa za ID: $idKutije: " . $conn->error;
            }
        } else {
            header("Location: ../kutijapaleta.php?message=Nema+palete+sa+tim+ID");
        }
    }

    $conn->close();
}

?>