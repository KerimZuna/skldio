<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../barcode/style.css?v=2"/>
		<meta charset="UTF-8" name="viewport" content="width=device-width"/>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Document</title>
</head>
<body>
<div class="col-md-6 well">
			<form method="POST" enctype="multipart/form-data" action="logika/paletalokacija.php">
				<div class="form-group" style="margin auto">
					<center><label>UNESITE ID PALETE:</label></center>
					<br>
					<input type="number" class="form-control" name="id_palete"/>
					<br/>
					<center><label>UNESITE LOKACIJU:</label></center>
					<br>
					<input type="text" class="form-control" name="lokacija"/>
                    <br>
					<center><button class="btn btn-primary" name="generate">PRINT</button></center>
					<br/>
				</div>
			</form>

			<a href="lokacija.php"><center><button class="btn btn-primary mt-5" name="nazad">NAZAD</button></center></a>
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