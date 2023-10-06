<?php
session_start();
include_once '../../conn.php';

    $korisnik = $_SESSION["username"];

if (isset($_POST['premjesti'])) {
    $idRegala = $_POST['idRegala'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    foreach ($_POST['idKutije'] as $key => $idKutije) {
        $query = "SELECT lokacija,kapacitet,slobodno FROM regali WHERE regal_id = '$idRegala'";
        $result = $conn->query($query);

        if ($result === false) {
            echo "Query error: " . $conn->error;
        } elseif ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lokacija = $row['lokacija'];
            $kapacitet = $row['kapacitet'];
            $slobodno = $row['slobodno'];

            $artikliquery = "SELECT kutija_id,regal_id FROM kutije WHERE kutija_id = '$idKutije'";
            $rezultat = $conn->query($artikliquery);
            $red = $rezultat->fetch_assoc();
            $kutija = $red['kutija_id'];
            $prosliRegal = $red['regal_id'];

            $paletaquery = "SELECT kapacitet, slobodno FROM regali WHERE regal_id = '$prosliRegal'";
                $kut = $conn->query($paletaquery);
                $red1 = $kut->fetch_assoc();
                $pkKapacitet = $red1['kapacitet'];
                $pkSlobodno = $red1['slobodno'];
                if ($idRegala == $prosliRegal)
                {
                    $sql_isto_ime = "UPDATE kutije
                    SET regal_id = '$idRegala',
                        lokacija = '$lokacija',
                        slobodno = '$slobodno'
                    WHERE kutija_id = '$idKutije'";
                    if ($conn->query($sql_isto_ime) !== TRUE) {
                        echo "Error: " . $sql_isto_ime . "<br>" . $conn->error;
                    }
                    header("Location: ../kutijaregal.php");
                    break;
                }
                else{
                            if ($slobodno == 0) {
                                header("Location: ../kutijaregal.php?message=$idKutije+nije+spremljen:++Regal+nema+kapacitet,+molimo+unesite+drugu+paletu.");
                                break;
                            } else {
                                $slobodno--;
                                $pkSlobodno++;
                                $sql_update_stara_paleta = "UPDATE regali SET slobodno = $slobodno WHERE regal_id = '$idRegala'";
                                $sql_update_nova_paleta = "UPDATE regali SET slobodno = $pkSlobodno WHERE regal_id = '$prosliRegal'";
                                if ($conn->query($sql_update_stara_paleta) !== TRUE) {
                                    echo "Error: " . $sql_update_stara_paleta . "<br>" . $conn->error;
                                }
                                if ($conn->query($sql_update_nova_paleta) !== TRUE) {
                                    echo "Error: " . $sql_update_nova_paleta. "<br>" . $conn->error;
                                }
                            }


                        $sql_update = "UPDATE kutije
                        SET regal_id = '$idRegala',
                            lokacija = '$lokacija'
                        WHERE kutija_id = '$idKutije'";

                        if ($conn->query($sql_update) === TRUE) {
                            if ($conn->affected_rows > 0) {
                                header("Location: ../kutijaregal.php?message=Uspješno+sačuvane+kutije+u+regal+$idRegala");
                            } else {
                                echo "Nisu napravljene promjene za ID: $idKutije";
                                header("Location: ../kutijaregal.php");
                            }
                        } else {
                            echo "Greška pri ažuriranju/umetanju zapisa za ID: $idKutije: " . $conn->error;
                        }

                        $sql = "UPDATE artikli SET id_regala = '$idRegala', lokacija = '$lokacija' WHERE id_kutije = '$idKutije'";
                        if ($conn->query($sql) !== TRUE) {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                            break;
                        }
                        
                        $sql_other_table = "INSERT INTO historija (korisnik, akcija, id_regala, id_kutije) VALUES ('$korisnik', 'Premještanje kutije $idKutije u regal $idRegala', '$idRegala','$idKutije')";
                        if ($conn->query($sql_other_table) !== TRUE) {
                            echo "Error: " . $sql_other_table . "<br>" . $conn->error;
                            break;
                        }
                        


                        
                    } 
        }else {
            header("Location: ../kutijaregal.php?message=Nema+regala+sa+tim+ID");
        }
    }

    $conn->close();
}
?>