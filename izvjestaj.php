<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Retrieval</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1 style="text-align: center;"class="mt-5">Izvještaj kutija</h1>
        <form method="POST" action="izvjestaj_logika.php" class="mt-3">
            <div class="form-group">
                <label for="inputNumber">Unesite ID kutije:</label>
                <input type="number" id="inputNumber" name="inputNumber" class="form-control" required>
            </div>
            <div style="display:flex; justify-content:center"><button type="submit" name="submit" class="btn btn-primary">Izvještaj</button></div><br>
        </form>
        <div><a href="index.php"><button class="btn btn-primary" style="display:block; margin: auto;">Nazad</button></a></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
