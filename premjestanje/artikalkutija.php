<<<<<<< HEAD
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
        <form method="POST" enctype="multipart/form-data" action="logika/artikalkutija.php">
            <div class="row">
                <div class="col-8" id="inputFieldsContainer">
                    <input type="number" class="form-control mb-5" placeholder="Unesite artikal" id="dodajArtikal">
                    
                    <div class="col-4"><button class="btn btn-primary" style="height: 38px; margin-left: 20px; padding:inherit;"type="button" name="dodaj" id="dodaj">Dodaj</button></div>
                </div>
            </div>
            <div class="col-10">
                <table class="table table-striped" id="enteredValuesTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID Artikla</th>
                            <th scope="col">Obriši</th>
                        </tr>
                    </thead>
                    <tbody id="enteredValues"></tbody>
                </table>
            </div>

            <label for="idKutije">ID kutije:</label>
            <input class="form-control mt-3" type="number" id="idKutije" name="idKutije" placeholder="Unesite id kutije">
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
        let counter = 0;

        document.getElementById("dodaj").addEventListener("click", function () {
            const dodajArtikal = document.getElementById("dodajArtikal");
            const enteredValues = document.getElementById("enteredValues");
            const enteredValuesTable = document.getElementById("enteredValuesTable");

            const inputValue = dodajArtikal.value.trim();

            if (inputValue !== "") {
                const name = "idArtikla[]";
                const id = name + counter;

                const newRow = enteredValuesTable.insertRow();
                const cell1 = newRow.insertCell(0);
                const cell2 = newRow.insertCell(1);
                const cell3 = newRow.insertCell(2);

                cell1.innerHTML = counter + 1;
                cell2.innerHTML = inputValue;
                cell3.innerHTML = '<button class="btn btn-danger btn-sm" onclick="deleteRow(this, \'' + id + '\')">Obriši</button>';

                const hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = id;
                hiddenInput.value = inputValue;

                document.querySelector("form").appendChild(hiddenInput);

                counter++;

                dodajArtikal.value = "";
            }
        });

        function deleteRow(button, fieldName) {
    const row = button.closest('tr');
    console.log(row);
    
    const hiddenInput = document.querySelector(`input[type="hidden"][name="${fieldName}"]`);
    console.log(hiddenInput);
    hiddenInput.remove();
    counter--;

    row.remove();
}


    </script>
</body>
</html>
=======
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
        <form method="POST" enctype="multipart/form-data" action="logika/artikalkutija.php">
            <div class="row">
                <div class="col-8" id="inputFieldsContainer">
                    <input type="number" class="form-control mb-5" placeholder="Unesite artikal" id="dodajArtikal">
                    
                    <div class="col-4"><button class="btn btn-primary" style="height: 38px; margin-left: 20px; padding:inherit;"type="button" name="dodaj" id="dodaj">Dodaj</button></div>
                </div>
            </div>
            <div class="col-10">
                <table class="table table-striped" id="enteredValuesTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID Artikla</th>
                            <th scope="col">Obriši</th>
                        </tr>
                    </thead>
                    <tbody id="enteredValues"></tbody>
                </table>
            </div>

            <label for="idKutije">ID kutije:</label>
            <input class="form-control mt-3" type="number" id="idKutije" name="idKutije" placeholder="Unesite id kutije">
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
        let counter = 0;

        document.getElementById("dodaj").addEventListener("click", function () {
            const dodajArtikal = document.getElementById("dodajArtikal");
            const enteredValues = document.getElementById("enteredValues");
            const enteredValuesTable = document.getElementById("enteredValuesTable");

            const inputValue = dodajArtikal.value.trim();

            if (inputValue !== "") {
                const name = "idArtikla[]";
                const id = name + counter;

                const newRow = enteredValuesTable.insertRow();
                const cell1 = newRow.insertCell(0);
                const cell2 = newRow.insertCell(1);
                const cell3 = newRow.insertCell(2);

                cell1.innerHTML = counter + 1;
                cell2.innerHTML = inputValue;
                cell3.innerHTML = '<button class="btn btn-danger btn-sm" onclick="deleteRow(this, \'' + id + '\')">Obriši</button>';

                const hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = id;
                hiddenInput.value = inputValue;

                document.querySelector("form").appendChild(hiddenInput);

                counter++;

                dodajArtikal.value = "";
            }
        });

        function deleteRow(button, fieldName) {
    const row = button.closest('tr');
    console.log(row);
    
    const hiddenInput = document.querySelector(`input[type="hidden"][name="${fieldName}"]`);
    console.log(hiddenInput);
    hiddenInput.remove();
    counter--;

    row.remove();
}


    </script>
</body>
</html>
>>>>>>> 0ce7764a707c14f33bc28774473029c971784320
