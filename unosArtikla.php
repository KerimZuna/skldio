<?php
include_once 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the scanned barcode data from the POST request
    $scannedValue = $_POST["barcode"];

    // Prepare and execute the SQL query to insert data into the database
    $sql = "INSERT INTO unos (scanned_value) VALUES ($scannedValue)";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute()) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // If no data is received, display a message or perform other actions as needed
    echo "No data received from the scanner.";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unos vozila</title>
    <link rel="stylesheet" href="styles.css?v=3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="form-body">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Unesite novo vozilo</h3>
                        <p>Ispunite sve podatke</p>
                        <form action="save.php" method="POST" enctype="multipart/form-data">

                            <div class="col-md-12">
                                <input class="form-control" type="text" name="naziv" placeholder="Naziv vozila"
                                    required>
                            </div>

                            <div class="col-md-12">
                                <select class="form-select mt-3" name="status" required>
                                    <option selected disabled value="">Status</option>
                                    <option value="Aktivno">AKTIVNO </option>
                                    <option value="Neaktivno">NEAKTIVNO</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <select class="form-select mt-3" name="namjena" required>
                                    <option selected disabled value="">Namjena</option>
                                    <option value="Civilno">CIVILNO</option>
                                    <option value="Obojeno">OBOJENO</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <input class="form-control" type="number" name="starost" placeholder="Starost" min="1"
                                    required>
                            </div>

                            <div class="col-md-12">
                                <input class="form-control" type="text" name="boja" placeholder="Boja" required>
                            </div>

                            <div class="col-md-12">
                                <input class="form-control" type="number" name="godina" placeholder="Godina proizvodnje"
                                    min="2000" required>
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" type="text" name="regbroj" placeholder="Registracijski broj"
                                    required>
                            </div>

                            <div class="col-md-12">
                                <input placeholder="Datum isteka registracije" class="form-control" type="text"
                                    onfocus="(this.type='date')" id="date" name="datum" />
                            </div>

                            <div class="col-md-12">
                                <select class="form-select mt-3" name="gorivo" required>
                                    <option selected disabled value="">Gorivo</option>
                                    <option value="Nafta">NAFTA</option>
                                    <option value="Benzin">BENZIN</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <input class="form-control" type="text" name="korisnik" placeholder="Korisnik" required>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="licna_karta">Lična karta:</label>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" type="file" accept="image/*" name="licna_karta"
                                        id="licna_karta" placeholder="Lična karta" required>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="saobracajna_karta">Saobraćajna karta:</label>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" type="file" accept="image/*" name="saobracajna_karta"
                                        id="saobracajna_karta" placeholder="Saobraćajna karta" required>
                                </div>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required
                                    style="margin-top: 1.125rem;">
                                <label class="form-check-label" style="margin-left: 1.125rem;">Potvrđujem da su svi
                                    uneseni podaci ispravni</label>
                            </div>


                            <div class="form-button d-flex justify-content-center mt-3">
                                <button type="submit" name="submit" class="btn btn-dark btn-lg mx-2">UNOS</button>
                                <button type="button" class="btn btn-dark btn-lg mx-2"><a
                                        href="table.php">LISTA</a></button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>