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
        $query = "SELECT * FROM palete WHERE paleta_id = '$idPalete'";
        $result = $conn->query($query);

        if ($result === false) {
            echo "Query error: " . $conn->error;
        } elseif ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lokacija = $row['lokacija'];
            $kapacitet = $row['kapacitet'];
            $slobodno = $row['slobodno'];
            $id_regala = $row['regal_id'];

            $artikliquery = "SELECT id_artikla, id_palete FROM artikli WHERE id_artikla = '$idArtikla'";
            $rezultat = $conn->query($artikliquery);
            $red = $rezultat->fetch_assoc();
            $artikal = $red['id_artikla'];
            $proslaPaleta = $red['id_palete'];

            $paletaquery = "SELECT kapacitet, slobodno FROM palete WHERE paleta_id = '$proslaPaleta'";
                $kut = $conn->query($paletaquery);
                $red1 = $kut->fetch_assoc();
                $pkKapacitet = $red1['kapacitet'];
                $pkSlobodno = $red1['slobodno'];

            if ($artikal != $idArtikla){
                if ($slobodno == 0) {
                    header("Location: ../artikalpaleta.php?message=$idArtikla+nije+spremljen:++Paleta+nema+kapacitet,+molimo+unesite+drugu+paletu.");
                    break;
                } else{
                    $slobodno--;
                    $sql_palete = "UPDATE palete SET slobodno = $slobodno WHERE paleta_id = '$idPalete'";
                    if ($conn->query($sql_palete) !== TRUE) {
                        echo "Error: " . $sql_palete . "<br>" . $conn->error;
                    }
                }  
            $sql = "INSERT INTO artikli (id_artikla, id_palete, lokacija, id_regala)
            VALUES ('$idArtikla', '$idPalete', '$lokacija','$id_regala')";
                
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

                if ($slobodno == 0) {
                    header("Location: ../artikalpaleta.php?message=$idArtikla+nije+spremljen:++Paleta+nema+kapacitet,+molimo+unesite+drugu+paletu.");
                    break;
                } else if ($proslaPaleta == $idPalete) {
                    $sql_palete = "UPDATE palete SET slobodno = $slobodno WHERE paleta_id = '$idPalete'";
                    if ($conn->query($sql_palete) !== TRUE) {
                        echo "Error: " . $sql_palete . "<br>" . $conn->error;
                    }
    
    
                } else {
                    $slobodno--;
                    $pkSlobodno++;
                    $sql_update_stara_paleta = "UPDATE palete SET slobodno = $slobodno WHERE paleta_id = '$idPalete'";
                    $sql_update_nova_paleta = "UPDATE palete SET slobodno = $pkSlobodno WHERE paleta_id = '$proslaPaleta'";
                    if ($conn->query($sql_update_stara_paleta) !== TRUE) {
                        echo "Error: " . $sql_update_stara_paleta . "<br>" . $conn->error;
                    }
                    if ($conn->query($sql_update_nova_paleta) !== TRUE) {
                        echo "Error: " . $sql_update_nova_paleta. "<br>" . $conn->error;
                    }
                }


            $sql_update = "UPDATE artikli
            SET id_palete = '$idPalete',
                lokacija = '$lokacija',
                id_regala = '$id_regala'
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
