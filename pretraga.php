<?php
include "conn.php";

$sql = "SHOW TABLES";
$result = $conn->query($sql);

$tables = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_row()) {
        $tables[] = $row[0];
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="pretraga.css?v=2" />
    <meta charset="UTF-8" name="viewport" content="width=device-width" />
    <title>PRETRAGA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="col-md-6 vh-100">
        <form method="POST" action="pretraga_logika.php">
            <div class="form-group" style="margin-top: 70px">
                <center><label for="broj">PRETRAGA</label></center>
                <br />

                <input type="text" class="form-control" style="width: 220px!important" name="search"
                    placeholder="Pretraga...">

                <br />
                <center><button class="btn btn-primary" name="dodaj" id="dodaj"
                        style="width: 220px!important">TRAŽI</button></center>
                <br />
            </div>
        </form>
        <a href="index.php">
            <center><button class="btn btn-primary" name="nazad" style="width: 220px!important">NAZAD</button>
            </center>
        </a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>