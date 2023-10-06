<?php
session_start();
include_once '../../conn.php';

    $korisnik = $_SESSION["username"];

if (isset($_POST['premjesti'])) {
    $idRegala = $_POST['idRegala'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    foreach ($_POST['idPalete'] as $key => $idPalete) {
        $query = "SELECT lokacija,kapacitet,slobodno FROM regali WHERE regal_id = '$idRegala'";
        $result = $conn->query($query);

        if ($result === false) {
            echo "Query error: " . $conn->error;
        } elseif ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lokacija = $row['lokacija'];
            $kapacitet = $row['kapacitet'];
            $slobodno = $row['slobodno'];

            $artikliquery = "SELECT paleta_id,regal_id FROM palete WHERE paleta_id = '$idPalete'";
            $rezultat = $conn->query($artikliquery);
            $red = $rezultat->fetch_assoc();
            $paleta = $red['paleta_id'];
            $prosliRegal = $red['regal_id'];

            $paletaquery = "SELECT kapacitet, slobodno FROM regali WHERE regal_id = '$prosliRegal'";
                $kut = $conn->query($paletaquery);
                $red1 = $kut->fetch_assoc();
                $pkKapacitet = $red1['kapacitet'];
                $pkSlobodno = $red1['slobodno'];
                if ($idRegala == $prosliRegal)
                {
                    $sql_isto_ime = "UPDATE palete
                    SET regal_id = '$idRegala',
                        lokacija = '$lokacija',
                        slobodno = '$slobodno'
                    WHERE paleta_id = '$idPalete'";
                    if ($conn->query($sql_isto_ime) !== TRUE) {
                        echo "Error: " . $sql_isto_ime . "<br>" . $conn->error;
                    }
                    header("Location: ../paletaregal.php");
                    break;
                }
                else{
                            if ($slobodno == 0) {
                                header("Location: ../paletaregal.php?message=$idPalete+nije+spremljen:++Regal+nema+kapacitet,+molimo+unesite+drugu+paletu.");
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


                        $sql_update = "UPDATE palete
                        SET regal_id = '$idRegala',
                            lokacija = '$lokacija'
                        WHERE paleta_id = '$idPalete'";


                        $sql_update_kutije = "UPDATE kutije
                        SET regal_id = '$idRegala',
                            lokacija = '$lokacija'
                        WHERE paleta_id = '$idPalete'";

                        if ($conn->query($sql_update_kutije) !== TRUE) {
                            echo "Error: " . $sql_update_kutije . "<br>" . $conn->error;
                            break;
                        }

                        if ($conn->query($sql_update) === TRUE) {
                            if ($conn->affected_rows > 0) {
                                header("Location: ../paletaregal.php?message=Uspješno+sačuvane+palete+u+regal+$idRegala");
                            } else {
                                echo "Nisu napravljene promjene za ID: $idPalete";
                                header("Location: ../paletaregal.php");
                            }
                        } else {
                            echo "Greška pri ažuriranju/umetanju zapisa za ID: $idPalete: " . $conn->error;
                        }

                        $sql = "UPDATE artikli 
                        SET id_regala = '$idRegala', 
                            lokacija = '$lokacija' 
                        WHERE id_palete = '$idPalete'";

                        
                        if ($conn->query($sql) !== TRUE) {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                            break;
                        }
                        
                        $sql_other_table = "INSERT INTO historija (korisnik, akcija, id_regala, id_palete) VALUES ('$korisnik', 'Premještanje palete $idPalete u regal $idRegala', '$idRegala','$idPalete')";
                        if ($conn->query($sql_other_table) !== TRUE) {
                            echo "Error: " . $sql_other_table . "<br>" . $conn->error;
                            break;
                        }
                        


                        
                    } 
        }else {
            header("Location: ../paletaregal.php?message=Nema+regala+sa+tim+ID");
        }
    }

    $conn->close();
}
?>