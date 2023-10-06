
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<style> 

<style>
       
       @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;900&display=swap');

*,
body {
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
    -webkit-font-smoothing: antialiased;
    text-rendering: optimizeLegibility;
    background-color: #fbad07;
}

html{
    background-color: #fbad07;
}

::placeholder {
    color: black;
    opacity: 1;
}

html,
body {
    height: 100%;
    background-color: white;
    overflow-x: hidden;
    background-color: #fbad07;
}

.form-check-input[type=checkbox] {
    border-radius: 1.25em!important;
}

label {
    margin-top: 1rem;
}

.form-select .mt-3 {
    margin-top: 0px!important;
}

input.form-control {
    margin-top: 1rem;
}

.row {
    align-items: center;
}

.col-md-12 {
    display: flex;
}

table {
    margin-left: auto;
    margin-right: auto;
    width: 100%;
}

td {
    text-align: center;
    font-size: 20px;
}

th {
    text-align: center;
    font-size: 22px;
    font-weight: 500;
}

table,
tr,
td,
th {
    border: 1px black solid;
}


.container {
    max-width: 1200px;
}


.table {
    width: 100%;
    margin-bottom: 1rem;
    color: black;
    background-color: transparent;
    border-collapse: collapse;
}

.table th,
.table td, thead,tbody {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid black;
}

.btn-primary {
  background-color: #212529!important; /* Set button background color */
  border-color: #212529!important; /* Set button border color */
  color: #fff!important; /* Set button text color */
  font-size: 20px!important;
}

.btn-primary:hover {
  background-color: #f60!important; /* Set button background color on hover */
  border-color: #f60!important; /* Set button border color on hover */

}
@media (max-width: 768px)
{

    html{
        background-color: #fbad07;
    }
    td{
        font-size:15px;
    }

    th{
        font-size:18px;
    }
}
</style>


<?php
session_start();
include 'conn.php';

$korisnik = $_SESSION["username"];

if (isset($_POST['submit'])) {
    $inputNumber = $_POST['inputNumber'];
    $sql1 = "SELECT * FROM kutije WHERE kutija_id = '$inputNumber'";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        $row1 = $result1->fetch_assoc();
        $slobodno = $row1['slobodno'];
        $kapacitet = $row1['kapacitet'];
        $lokacija = $row1['lokacija'];
        $id_regala = $row1['paleta_id'];
        $id_palete = $row1['regal_id'];
        $sql2 = "SELECT * FROM artikli WHERE id_kutije = '$inputNumber'";
        $result2 = $conn->query($sql2);
            echo "<div class='container'>";
            echo "<h2 style='text-align: center;'>Artikli u kutiji " . $inputNumber . ":</h2>";
            echo "<table class='table table-striped'>";
            echo "<tr><th style='font-size:22px'>ID dijela</th></tr>";
            
            while ($row2 = $result2->fetch_assoc()) {
                echo "<tr>";
                echo "<td style='font-size: 20px'>" . $row2['id_artikla'] . "</td>";
                echo "</tr>";
            }
            
            echo "</table><br>";
            echo "<p style='text-align: center; font-size: 20px;'><strong>ID Regala:</strong> " . $id_regala . "</p>";
            echo "<p style='text-align: center; font-size: 20px;'><strong>ID Palete:</strong> " . $id_palete . "</p>";
            echo "<p style='text-align: center; font-size: 20px;'><strong>Kapacitet:</strong> " . $kapacitet . "</p>";
            echo "<p style='text-align: center; font-size: 20px;'><strong>Slobodno:</strong> " . $slobodno . "</p>";
            echo "<p style='text-align: center; font-size: 20px;'><strong>Lokacija:</strong> " . $lokacija . "</p>";
            echo "<div style='display: flex; justify-content: center; '><a href='izvjestaj.php' class='btn btn-primary'>Nazad</a></div>";
            echo "</div>"; 
        }
    } else {
        header("Location: izvjestaj.php?message=Nema+kutije+sa+tim+ID");
}
?>
