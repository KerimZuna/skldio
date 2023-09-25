<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WMS - AutoTarget</title>
    <link href="styles.css?v=2" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="manifest" href="manifest.json">

</head>

<body>
    <div class="container mt-2">
        <div class="row">

            <div class="col-6">
                <div class="square">

                    <a href="unos.php">
                        <img src="ikone/ikona1.png" alt="Icon 1">
                        <h6>UNOS</h6>
                    </a>
                </div>
            </div>
            <div class="col-6">
                <div class="square">
                    <a href="premjestanje.php">
                        <img src="ikone/ikona2.png" alt="Icon 2">
                        <h6>PREMJEŠTANJE</h6>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="square">
                    <a href="izlazrobe.php">
                        <img src="ikone/ikona10.png" alt="Icon 10">
                        <h6>IZLAZ ROBE</h6>
                    </a>
                </div>
            </div>
            <div class="col-6">
                <div class="square">
                    <a href="historija.php">
                        <img src="ikone/ikona6.png" alt="Icon 6">
                        <h6>HISTORIJA</h6>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="square">
                    <a href="izvjestaj.php">
                        <img src="ikone/izvjestaj.png" alt="Icon 3">
                        <h6>IZVJEŠTAJ</h6>
                    </a>
                </div>
            </div>
            <div class="col-6">
                <div class="square">
                    <a href="pretraga.php">
                        <img src="ikone/pretraga.png" alt="Icon 4">
                        <h6>PRETRAGA</h6>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="square">
                    <a href="barcode/index.php">
                        <img src="ikone/ikona8.png" alt="Icon 8">
                        <h6>PRINT</h6>
                    </a>
                </div>
            </div>
            <div class="col-6">
                <div class="square">
                    <img src="ikone/postavke.png" alt="Icon 5">
                    <h6>POSTAVKE</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="square">
                    <a href="logout.php">
                        <img src="ikone/ikona11.png" alt="Icon 9">
                        <h6>ODJAVA</h6>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>

</html>