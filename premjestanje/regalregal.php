<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css?v=4"/>
    <meta charset="UTF-8" name="viewport" content="width=device-width"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>WMS - AutoTarget</title>
</head>
<body>
    <div class="col-6 well">
        <form method="POST" enctype="multipart/form-data" action="logika/regalregal.php">
            
        <label for="idRegala">ID regala kojeg zelite premjestiti:</label>
                <div class="col-12" id="inputFieldsContainer">
                    <input type="number" class="form-control mt-3 mb-5" placeholder="Unesite regal" id="dodajRegal" name="dodajRegal">
                </div>

            <label for="idRegala">ID regala u koji zelite premjestiti:</label>
            <input class="form-control mt-3" type="number" id="idRegala" name="idRegala" placeholder="Unesite id regala">
            <br><br>

            <button class="btn btn-primary" id="premjesti" name="premjesti">Premjesti</button>
        </form>
        <a href="../premjestanje.php"><center><button class="btn btn-primary mt-5 mb-2" name="nazad">NAZAD</button></center></a>
    </div>

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
