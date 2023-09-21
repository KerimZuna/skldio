<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="style.css?v=2"/>
		<meta charset="UTF-8" name="viewport" content="width=device-width"/>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	</head>
<body>
	<div class="col-md-6 well">
			<form method="POST" enctype="multipart/form-data" action="generate.php">
				<div class="form-group" style="margin auto">
					<center><label>UNESITE ID ZA PRINTANJE:</label></center>
					<br>
					<input type="text" class="form-control" name="barcode"/>
					<br/>
					<center><button class="btn btn-primary" name="generate">PRINT</button></center>
					<br/>
				</div>
			</form>

			<a href="../index.php"><center><button class="btn btn-primary mt-5" name="nazad">NAZAD</button></center></a>
	</div>
	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>