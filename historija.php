<?php
include 'conn.php';

$tableName = "historija";


$search = "";
// Check if a search query is submitted
if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $sql = "SELECT * FROM $tableName WHERE korisnik LIKE '%$search%' OR akcija LIKE '%$search%' OR datum_unosa LIKE '%$search%'";
} else {
    // Fetch all data from the database if no search query is provided
    $sql = "SELECT korisnik, akcija,datum_unosa FROM $tableName";
}

$result = mysqli_query($conn, $sql);

// Define a variable to store the ID of the record being edited
$editRecordID = null;

?>

<!DOCTYPE html>
<html>

<head>
    <title>WMS - AutoTarget - Historija</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
            border-radius: 1.25em !important;
        }

        label {
            margin-top: 1rem;
        }

        .form-select .mt-3 {
            margin-top: 0px !important;
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
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid black;
        }

        @media (max-width: 768px) {
            td {
                font-size: 15px;
            }

            th {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="index.php"><button class="btn btn-dark"
                        style="height: fit-content; margin-top: 16px; margin-right:10px;">Nazad</button></a>
                <form method="POST" class="mb-3" style="display: inline-block; width: 100%;">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Pretraga" name="search"
                            value="<?php echo $search; ?>">
                        <button type="submit" class="btn btn-dark"
                            style="height: fit-content; margin-top: auto; margin-right: 0px">Pretraži</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <table>
        <thead>
            <tr>
                <!-- Display column headers for 'korisnik' and 'akcija' only -->
                <th>Korisnik</th>
                <th>Akcija</th>
                <th>Vrijeme</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Display table data for 'korisnik' and 'akcija' only
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['korisnik']}</td>";
                echo "<td>{$row['akcija']}</td>";
                echo "<td>{$row['datum_unosa']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>