<<<<<<< HEAD
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
=======
<?php
session_start();
include_once '../../conn.php';

    $korisnik = $_SESSION["username"];

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
            $artikliquery = "SELECT id_artikla FROM artikli WHERE id_artikla = '$idArtikla'";
            $rezultat = $conn->query($artikliquery);
            $red = $rezultat->fetch_assoc();
            $artikal = $red['id_artikla'];

            if ($artikal != $idArtikla){
            $sql = "INSERT INTO artikli (id_artikla, id_kutije, lokacija)
            VALUES ('$idArtikla', '$idKutije', '$lokacija')";
                
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
                $sql_other_table = "INSERT INTO historija (korisnik, akcija, id_kutije, id_dijela) VALUES ('$korisnik', 'Dodavanje artikla $idArtikla u kutiju $idKutije', '$idKutije','$idArtikla')";
            if ($conn->query($sql_other_table) !== TRUE) {
                echo "Error: " . $sql_other_table . "<br>" . $conn->error;
                break;
            }
            }
            else{
            $sql_update = "UPDATE artikli
            SET id_kutije = '$idKutije',
                lokacija = '$lokacija'
            WHERE id_artikla = '$idArtikla'";

            if ($conn->query($sql_update) === TRUE) {
                if ($conn->affected_rows > 0) {
                    header("Location: ../artikalkutija.php?message=Uspješno+sačuvani+artikli+u+kutiju+$idKutije");
                } else {
                    echo "Nisu napravljene promjene za ID: $idArtikla";
                    header("Location: ../artikalkutija.php");
                }
            } else {
                echo "Greška pri ažuriranju/umetanju zapisa za ID: $idArtikla: " . $conn->error;
            }

            $sql_other_table = "INSERT INTO historija (korisnik, akcija, id_kutije, id_dijela) VALUES ('$korisnik', 'Premještanje artikla $idArtikla u kutiju $idKutije', '$idKutije','$idArtikla')";
            if ($conn->query($sql_other_table) !== TRUE) {
                echo "Error: " . $sql_other_table . "<br>" . $conn->error;
                break;
            }
            }
            


            
        } else {
            header("Location: ../artikalkutija.php?message=Nema+kutije+sa+tim+ID");
        }
    }

    $conn->close();
}

?>
>>>>>>> 0ce7764a707c14f33bc28774473029c971784320
