<?php
session_start();
include_once '../../conn.php';

    $korisnik = $_SESSION["username"];

if (isset($_POST['premjesti'])) {
    $idPalete = $_POST['idPalete'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    foreach ($_POST['idKutije'] as $key => $idKutije) {
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

            $artikliquery = "SELECT * FROM kutije WHERE kutija_id = '$idKutije'";
            $rezultat = $conn->query($artikliquery);
            $red = $rezultat->fetch_assoc();
            $kutija = $red['kutija_id'];
            $proslaPaleta = $red['paleta_id'];

            $paletaquery = "SELECT kapacitet, slobodno FROM palete WHERE paleta_id = '$proslaPaleta'";
                $kut = $conn->query($paletaquery);
                $red1 = $kut->fetch_assoc();
                $pkKapacitet = $red1['kapacitet'];
                $pkSlobodno = $red1['slobodno'];
                if ($idPalete == $proslaPaleta)
                {
                    $sql_isto_ime = "UPDATE kutije
                    SET paleta_id = '$idPalete',
                        lokacija = '$lokacija',
                        slobodno = '$slobodno'
                    WHERE kutija_id = '$idKutije'";
                    if ($conn->query($sql_isto_ime) !== TRUE) {
                        echo "Error: " . $sql_isto_ime . "<br>" . $conn->error;
                    }
                    header("Location: ../kutijapaleta.php");
                    break;
                }
                else{
                            if ($slobodno == 0) {
                                header("Location: ../kutijapaleta.php?message=$idKutije+nije+spremljen:++Paleta+nema+kapacitet,+molimo+unesite+drugu+paletu.");
                                break;
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


                        $sql_update = "UPDATE kutije
                        SET paleta_id = '$idPalete',
                            lokacija = '$lokacija'
                        WHERE kutija_id = '$idKutije'";

                        if ($conn->query($sql_update) === TRUE) {
                            if ($conn->affected_rows > 0) {
                                header("Location: ../kutijapaleta.php?message=Uspješno+sačuvani+artikli+u+paletu+$idPalete");
                            } else {
                                echo "Nisu napravljene promjene za ID: $idKutije";
                                header("Location: ../kutijapaleta.php");
                            }
                        } else {
                            echo "Greška pri ažuriranju/umetanju zapisa za ID: $idKutije: " . $conn->error;
                        }

                        $sql = "UPDATE artikli SET id_palete = '$idPalete', lokacija = '$lokacija', id_regala = '$id_regala' WHERE id_kutije = '$idKutije'";
                        if ($conn->query($sql) !== TRUE) {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                            break;
                        }
                        
                        $sql_other_table = "INSERT INTO historija (korisnik, akcija, id_palete, id_kutije) VALUES ('$korisnik', 'Premještanje kutije $idKutije u paletu $idPalete', '$idPalete','$idKutije')";
                        if ($conn->query($sql_other_table) !== TRUE) {
                            echo "Error: " . $sql_other_table . "<br>" . $conn->error;
                            break;
                        }
                        


                        
                    } 
        }else {
            header("Location: ../kutijapaleta.php?message=Nema+palete+sa+tim+ID");
        }
    }

    $conn->close();
}
?>