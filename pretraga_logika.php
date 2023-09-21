<?php
include "conn.php";

function generateTableHeader($columns)
{
    $header = "<thead class='thead-dark'><tr>";
    foreach ($columns as $column) {
        $header .= "<th>" . ucfirst($column) . "</th>";
    }
    $header .= "</tr></thead>";
    return $header;
}

$searchTerm = $_POST['search'];

// Specify the table you want to search in (artikli)
$table = "artikli";

// Generate a query to search in the specified table
$query = "SELECT * FROM $table WHERE ";
$columns = array(); // Store column names for WHERE clause

// Get column names of the current table
$columnsSql = "SHOW COLUMNS FROM $table";
$columnsResult = $conn->query($columnsSql);

while ($column = $columnsResult->fetch_assoc()) {
    $columns[] = $column['Field'];
}

// Create a WHERE clause for each column
$whereClauses = array();
foreach ($columns as $column) {
    $whereClauses[] = "$column = '$searchTerm'";
}

// Combine WHERE clauses with OR
$query .= implode(" OR ", $whereClauses);

// Execute the query
$result = $conn->query($query);

$searchResults = array();

// Store the search results for this table
while ($row = $result->fetch_assoc()) {
    $searchResults[] = $row;
}

$conn->close();
?>

<!-- Display the search results in your HTML -->
<!DOCTYPE html>
<html>

<head>
    <!-- Your head content here -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100% !important;
            font-size: 50px !important;
            background-color: #FBAD07 !important;
        }

        form {
            display: flex;
            width: 100%;
            justify-content: center;
            align-items: center;
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
</head>

<body>
    <div class="container mt-5">
        <!-- Display search results here -->
        <center>
            <h2 class="naslov mt-5">REZULTATI</h2>
        </center>
        <?php
        if (count($searchResults) > 0) {
            echo "<div class='table-responsive'>";
            echo "<table class='table table-bordered'>";
            // Generate table header from the first result
            $firstResult = reset($searchResults);
            $columns = array_keys($firstResult);
            echo generateTableHeader($columns);
            echo "<tbody>";

            foreach ($searchResults as $result) {
                echo "<tr>";
                foreach ($result as $value) {
                    echo "<td>" . $value . "</td>";
                }
                echo "</tr>";
            }

            echo "</tbody></table>";
            echo "</div>";
            echo "<center><a href='pretraga.php' class='btn btn-primary mt-3 w-100'>NAZAD</a></center>";
        } else {
            echo "<div class='alert alert-info mt-4'>Nisu pronađeni rezultati.</div>";
            echo "<center><a href='pretraga.php' class='btn btn-primary mt-3 w-100'>NAZAD</a></center>";
        }
        ?>
    </div>
</body>

</html>
