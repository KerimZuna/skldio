<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="kutija.css?v=3"/>
		<meta charset="UTF-8" name="viewport" content="width=device-width"/>
		<title>WMS - AutoTarget - Dodaj paletu</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	</head>
<body>
	<div class="col-md-6 well">
			<form method="POST" enctype="multipart/form-data" action="dodajpaletu.php">
				<div class="form-group" style="margin auto">
					<center><label for="broj">UNESITE BROJ PALETA:</label></center>
					<br>
					<select class="form-select mt-3" id="broj" name="broj" required autocomplete="off">
                                      <option selected disabled value="Broj">Broj</option>
                                      <option value="1">1 </option>
                                      <option value="2">2</option>
									  <option value="3">3 </option>
                                      <option value="4">4</option>
									  <option value="5">5 </option>
                                      <option value="6">6</option>
									  <option value="7">7 </option>
                                      <option value="8">8</option>
									  <option value="9">9 </option>
                                      <option value="10">10</option>
                               </select>
					<br/>
					<center><button class="btn btn-primary" name="dodaj" id="dodaj">DODAJ</button></center>
					<br/>
			</form>

			
			</div>
			<a href="unos.php"><center><button class="btn btn-primary mt-1 mb-2" name="nazad" style="width: 180px!important">NAZAD</button></center></a>
	<script>
    // Add a click event listener to the "DODAJ" button
    document.getElementById("dodaj").addEventListener("click", function (e) {
        // Get the selected value from the "broj" select element
        const selectedValue = document.getElementById("broj").value;

        // Check if a value is selected (not the default "Broj" option)
        if (selectedValue !== "Broj") {
            alert("Uspjesno ste dodali " + selectedValue + ' palete/a');
        } else {
            alert("Molimo odaberite vrijednost prije nego što dodate.");
        }
    });
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>