<?php 



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WMS - AutoTarget</title>
    <link href="../styles.css?v=2" rel="stylesheet">
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
                <a href="kutijalokacija.php">
                <div class="square">
                    <img style="max-height:100px; max-width:100px;" src="../ikone/kutija.png" alt="Icon 5">
                    <h6>KUTIJA-LOKACIJA</h6>
                </div>
                </a>
            </div>
            <div class="col-6">
            <a href="paletalokacija.php">    
            <div class="square">
                    <img style="max-height:100px; max-width:100px;" src="../ikone/paleta.png" alt="Icon 6">
                    <h6>PALETA-LOKACIJA</h6>
                </div>
            </div>
            </a>

        </div>
        <div class="row">
            <div class="col-6">
                <a href="../premjestanje.php">
                    <div class="square">
                        <img src="../ikone/nazad.png" alt="Icon 3">
                        <h6>NAZAD</h6>
                    </div>
                </a>
            </div>
        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>

</html>