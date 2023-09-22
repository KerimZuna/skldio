<?php
include 'conn.php';

$tableName = "historija";

// Query to select only 'korisnik' and 'akcija' columns from the specified table
$sql = "SELECT korisnik, akcija FROM $tableName";
$result = $conn->query($sql);

// Close the database connection (optional)
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>MySQL Table Viewer</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100% !important;
            background-color: #FBAD07 !important;
            background-color: #FBAD07 !important;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 35px !important;
            width: 100%;
        }

        form {
            display: flex;
            width: 100%;
            justify-content: center;
            align-items: center;

        }

        table {
            border: 2px black solid;
        }

        th {
            text-align: center;
            padding: 10px;
            border: 2px black solid;
        }

        td {
            border: 2px black solid;
        }

        .form-group label {
            font-weight: bold !important;
            color: #333 !important;
        }

        .form-group {
            margin-bottom: 0px;
        }

        .form-control {
            width: 100% !important;
            border-color: #FBAD07 !important;
        }

        .btn-primary {
            background-color: #212529 !important;
            border-color: #212529 !important;
            color: #fff !important;
            width: 100% !important;
            font-size: 70px !important;
        }

        .btn-primary:hover {
            background-color: #f60 !important;
            border-color: #f60 !important;
        }

        .center-button {
            text-align: center !important;
        }

        .naslov {
            font-size: 80px;
            margin-top: 200px !important;
            margin-bottom: 50px !important;
        }
    </style>
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <!-- Display column headers for 'korisnik' and 'akcija' only -->
                <th>Korisnik</th>
                <th>Akcija</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Display table data for 'korisnik' and 'akcija' only
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['korisnik']}</td>";
                echo "<td>{$row['akcija']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>