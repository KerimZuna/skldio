<?php
session_start();
include_once '../../conn.php';
$korisnik = $_SESSION["username"];
if (isset($_POST['premjesti'])) {
    $idPalete = $_POST['idPalete'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    foreach ($_POST['idArtikla'] as $key => $idArtikla) {
        $query = "SELECT lokacija FROM palete WHERE paleta_id = '$idPalete'";
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
            $sql = "INSERT INTO artikli (id_artikla, id_palete, lokacija)
            VALUES ('$idArtikla', '$idPalete', '$lokacija')";
                
                if ($conn->query($sql) === TRUE) {
                    if ($conn->affected_rows > 0) {
                        header("Location: ../artikalpaleta.php?message=Uspješno+sačuvani+artikli+u+paletu+$idPalete");
                    } else {
                        echo "Nisu napravljene promjene za ID: $idArtikla";
                        header("Location: ../artikalpaleta.php");
                    }
                } else {
                    echo "Greška pri ažuriranju/umetanju zapisa za ID: $idArtikla: " . $conn->error;
                }
                $sql_other_table = "INSERT INTO historija (korisnik, akcija, id_palete, id_dijela) VALUES ('$korisnik', 'Dodavanje artikla $idArtikla u paletu $idPalete', '$idPalete','$idArtikla')";
            if ($conn->query($sql_other_table) !== TRUE) {
                echo "Error: " . $sql_other_table . "<br>" . $conn->error;
                break;
            }
            }
            else{
            $sql_update = "UPDATE artikli
            SET id_palete = '$idPalete',
                lokacija = '$lokacija'
            WHERE id_artikla = '$idArtikla'";

            if ($conn->query($sql_update) === TRUE) {
                if ($conn->affected_rows > 0) {
                    header("Location: ../artikalpaleta.php?message=Uspješno+sačuvani+artikli+u+paletu+$idPalete");
                } else {
                    echo "Nisu napravljene promjene za ID: $idArtikla";
                    header("Location: ../artikalpaleta.php");
                }
            } else {
                echo "Greška pri ažuriranju/umetanju zapisa za ID: $idArtikla: " . $conn->error;
            }
            $sql_other_table = "INSERT INTO historija (korisnik, akcija, id_palete, id_dijela) VALUES ('$korisnik', 'Premještanje artikla $idArtikla u paletu $idPalete', '$idPalete','$idArtikla')";
            if ($conn->query($sql_other_table) !== TRUE) {
                echo "Error: " . $sql_other_table . "<br>" . $conn->error;
                break;
            }
            }
            


            
        } else {
            header("Location: ../artikalpaleta.php?message=Nema+palete+sa+tim+ID");
        }
    }

    $conn->close();
}

?>
