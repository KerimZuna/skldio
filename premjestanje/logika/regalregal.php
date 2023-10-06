<?php
session_start();
include_once '../../conn.php';

    $korisnik = $_SESSION["username"];

if (isset($_POST['premjesti'])) {
    $idRegala = $_POST['idRegala'];
    $noviRegal = $_POST['dodajRegal'];
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM regali WHERE regal_id = '$idRegala'";
    $result = $conn->query($query);

    if ($result === false) {
        echo "Query error: " . $conn->error;
    } elseif ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $slobodno = $row['slobodno'];
        $q = "SELECT * FROM regali WHERE regal_id = '$noviRegal'";
        $rez = $conn->query($q);

        if ($rez === false) {
            echo "Query error: " . $conn->error;
        }elseif ($result->num_rows > 0) {
            $novislobodno = $row['slobodno'];
            if ($novislobodno == 0){
                header("Location: ../regalregal.php?message=Regal+$noviRegal+nema+kapaciteta");
            }else{
                $artikliquery = "UPDATE artikli SET id_regala = '$noviRegal' WHERE id_regala = '$idRegala'";
                if ($conn->query($artikliquery) !== TRUE) {
                    echo "Error: " . $artikliquery . "<br>" . $conn->error;
                }

                $paletaquery = "UPDATE palete SET regal_id = '$noviRegal' WHERE regal_id = '$idRegala'";
                if ($conn->query($paletaquery) !== TRUE) {
                    echo "Error: " . $paletaquery . "<br>" . $conn->error;
                }

                $kutijaquery = "UPDATE kutije SET regal_id = '$noviRegal' WHERE regal_id = '$idRegala'";
                if ($conn->query($kutijaquery) !== TRUE) {
                    echo "Error: " . $kutijaquery . "<br>" . $conn->error;
                }

                $update_regal_novi = "UPDATE regali SET slobodno = '$slobodno' WHERE regal_id = '$noviRegal'";
                if ($conn->query($update_regal_novi) !== TRUE) {
                    echo "Error: " . $update_regal_novi . "<br>" . $conn->error;
                }

                $update_regal_stari = "UPDATE regali SET slobodno = '$novislobodno' WHERE regal_id = '$idRegala'";
                if ($conn->query($update_regal_stari) !== TRUE) {
                    echo "Error: " . $update_regal_stari . "<br>" . $conn->error;
                }

                $sql_other_table = "INSERT INTO historija (korisnik, akcija, id_regala) VALUES ('$korisnik', 'Premještanje regala $idRegala u regal $noviRegal', '$noviRegal')";
                if ($conn->query($sql_other_table) !== TRUE) {
                    echo "Error: " . $sql_other_table . "<br>" . $conn->error;
                }
                header("Location: ../regalregal.php?message=Uspjesno+prebaceno+u+$noviRegal");
            }
        }
        else {
        header("Location: ../regalregal.php?message=Nema+regala+sa+tim+ID");
    }
        
    }else {
        header("Location: ../regalregal.php?message=Nema+regala+sa+tim+ID");
    }
    

    $conn->close();
}
?>