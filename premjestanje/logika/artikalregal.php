<?php
include_once '../../conn.php';

if (isset($_POST['premjesti'])) {
    $idRegala = $_POST['idRegala'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    foreach ($_POST['idArtikla'] as $key => $idArtikla) {
        $query = "SELECT lokacija FROM regali WHERE regal_id = '$idRegala'";
        $result = $conn->query($query);

        if ($result === false) {
            echo "Query error: " . $conn->error;
        } elseif ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lokacija = $row['lokacija'];

            $sql = "INSERT INTO artikli (id_artikla, id_regala, lokacija)
            VALUES ('$idArtikla', '$idRegala', '$lokacija')
            ON DUPLICATE KEY UPDATE
            id_regala = '$idRegala',
            lokacija = '$lokacija'";

            if ($conn->query($sql) === TRUE) {
                if ($conn->affected_rows > 0) {
                    header("Location: ../artikalregal.php?message=Uspješno+sačuvani+artikli+u+regal+$idRegala");
                } else {
                    echo "Nisu napravljene promjene za ID: $idArtikla";
                    header("Location: ../artikalregal.php");
                }
            } else {
                echo "Greška pri ažuriranju/umetanju zapisa za ID: $idArtikla: " . $conn->error;
            }
        } else {
            header("Location: ../artikalregal.php?message=Nema+regala+sa+tim+ID");
        }
    }

    $conn->close();
}

?>