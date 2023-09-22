<?php
include_once '../../conn.php';

if (isset($_POST['premjesti'])) {
    $idKutije = $_POST['idKutije'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    foreach ($_POST['idArtikla'] as $key => $idArtikla) {
        $query = "SELECT lokacija FROM kutije WHERE kutija_id = '$idKutije'";
        $result = $conn->query($query);

        if ($result === false) {
            echo "Query error: " . $conn->error;
        } elseif ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lokacija = $row['lokacija'];

            $sql = "INSERT INTO artikli (id_artikla, id_kutije, lokacija)
            VALUES ('$idArtikla', '$idKutije', '$lokacija')
            ON DUPLICATE KEY UPDATE
            id_kutije = '$idKutije',
            lokacija = '$lokacija'";

            if ($conn->query($sql) === TRUE) {
                if ($conn->affected_rows > 0) {
                    header("Location: ../artikalkutija.php?message=Uspješno+sačuvani+artikli+u+kutiju+$idKutije");
                } else {
                    echo "Nisu napravljene promjene za ID: $idArtikla";
                    header("Location: ../artikalkutija.php");
                }
            } else {
                echo "Greška pri ažuriranju/umetanju zapisa za ID: $idArtikla: " . $conn->error;
            }
        } else {
            header("Location: ../artikalkutija.php?message=Nema+kutije+sa+tim+ID");
        }
    }

    $conn->close();
}

?>