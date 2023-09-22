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
        $query = "SELECT lokacija,kapacitet,slobodno FROM kutije WHERE kutija_id = '$idKutije'";
        $result = $conn->query($query);

        if ($result === false) {
            echo "Query error: " . $conn->error;
        } elseif ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lokacija = $row['lokacija'];
            $kapacitet = $row['kapacitet'];
            $slobodno = $row['slobodno'];

            $artikliquery = "SELECT id_artikla, id_kutije FROM artikli WHERE id_artikla = '$idArtikla'";
            $rezultat = $conn->query($artikliquery);
            $red = $rezultat->fetch_assoc();
            $artikal = $red['id_artikla'];
            $proslaKutija = $red['id_kutije'];

            $kutijaquery = "SELECT kapacitet, slobodno FROM kutije WHERE kutija_id = '$proslaKutija'";
                $kut = $conn->query($kutijaquery);
                $red1 = $kut->fetch_assoc();
                $pkKapacitet = $red1['kapacitet'];
                $pkSlobodno = $red1['slobodno'];

                file_put_contents("uahrvatska.txt", "$pkSlobodno, $slobodno");

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
            if ($slobodno == 0) {
                echo "Kutija nema kapacitet, molimo unesite drugu kutiju.";
            } else{
                $slobodno--;
                $sql_kutije = "UPDATE kutije SET slobodno = $slobodno WHERE kutija_id = '$idKutije'";
                if ($conn->query($sql_kutije) !== TRUE) {
                    echo "Error: " . $sql_kutije . "<br>" . $conn->error;
                }
            }  
            
        }
            else{
            $sql_update = "UPDATE artikli
            SET id_kutije = '$idKutije',
                lokacija = '$lokacija'
            WHERE id_artikla = '$idArtikla'";



            if ($slobodno == 0) {
                echo "Kutija nema kapacitet, molimo unesite drugu kutiju.";
            } else if ($proslaKutija == $idKutije) {
                $sql_kutije = "UPDATE kutije SET slobodno = $slobodno WHERE kutija_id = '$idKutije'";
                if ($conn->query($sql_kutije) !== TRUE) {
                    echo "Error: " . $sql_kutije . "<br>" . $conn->error;
                }


            } else {
                $slobodno--;
                $pkSlobodno++;
                $sql_update_stara_kutija = "UPDATE kutije SET slobodno = $slobodno WHERE kutija_id = '$idKutije'";
                $sql_update_nova_kutija = "UPDATE kutije SET slobodno = $pkSlobodno WHERE kutija_id = '$proslaKutija'";
                if ($conn->query($sql_update_stara_kutija) !== TRUE) {
                    echo "Error: " . $sql_update_stara_kutija . "<br>" . $conn->error;
                }
                if ($conn->query($sql_update_nova_kutija) !== TRUE) {
                    echo "Error: " . $sql_update_nova_kutija. "<br>" . $conn->error;
                }
            }

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
