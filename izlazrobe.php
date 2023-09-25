<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Bootstrap Page</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css?v=4">
</head>
<body>
    <div class="container mt-5">
        <form method="POST" enctype="multipart/form-data" action="izlaz_logika.php">
            <div class="form-group">
                <label for="idDijela">ID dijela:</label>
                <input type="text" class="form-control" id="idDijela" name="idDijela" placeholder="Unesite ID dijela">
            </div>
            <div class="form-group">
                <label for="trazio">Ko je tražio dio:</label>
                <select class="form-control" id="trazio" name="trazio">
                    <option value="">Odaberite opciju</option>
                    <option value="Edo">Edo</option>
                    <option value="Almir">Almir</option>
                    <option value="Ermin">Ermin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="lokacija">Lokacija:</label>
                <select class="form-control" id="lokacija" name="lokacija">
                    <option value="">Odaberite opciju</option>
                    <option value="Srbija">Srbija</option>
                    <option value="BiH">BiH</option>
                    <option value="Hrvatska">Hrvatska</option>
                    <option value="Crna Gora">Crna Gora</option>
                    <option value="Brza Pošta">Brza Pošta</option>
                    <option value="Lično Preuzimanje">Lično preuzimanje</option>
                </select>
            </div>
            <a href="index.php">
            <div class="form-group d-flex justify-content-center align-items-center">
            <button type="submit" class="btn btn-primary" id="spremi" name="spremi">Spremi</button>
        </div>
        </a>

        </form>
        <div class="form-group d-flex justify-content-center align-items-center">
            <a href="index.php" class="btn btn-primary">Nazad</a>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script> 
    function displayMessageFromURL() {
            const urlParams = new URLSearchParams(window.location.search);
            const message = urlParams.get("message");
            
            if (message) {
                alert(message);
            }
        }

        displayMessageFromURL();
</script>
</body>
</html>
