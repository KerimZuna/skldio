<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="stylesheet" type="text/css" href="kutija.css?v=3" />
	<meta charset="UTF-8" name="viewport" content="width=device-width" />
	<title>WMS - AutoTarget - Dodaj paletu</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
		integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<style>
		label{
			display: flex;
    justify-content: center;
		}
	</style>
</head>

<body>
	<div class="col-md-6 well vh-100">
		<form method="POST" enctype="multipart/form-data" action="dodajregal.php" style="flex-direction: column;">
		<div class="form-group">
                <label for="skladiste">Skladište</label>
                <input type="number" class="form-control mb-3" id="skladiste" name="skladiste" required>
            </div>
            <div class="form-group">
                <label for="regal_red">Red regala</label>
                <input type="number" class="form-control mb-3" id="regal_red" name="regal_red" required>
            </div>
            <div class="form-group">
                <label for="regal_kolona">Kolona regala</label>
                <input type="text" class="form-control mb-3" id="regal_kolona" name="regal_kolona" required>
            </div>
            <div class="form-group">
                <label for="regal_polje">Regal polje</label>
                <input type="number" class="form-control mb-3" id="regal_polje" name="regal_polje" required>
            </div>
            <div class="form-group">
                <label for="regal_polje_kolona">Regal polje kolona</label>
                <input type="number" class="form-control mb-3" id="regal_polje_kolona" name="regal_polje_kolona" required>
            </div>
            <div class="form-group">
                <label for="kapacitet">Kapacitet</label>
                <input type="number" class="form-control mb-5" id="kapacitet" name="kapacitet" required>
            </div>
            <button type="submit" class="btn btn-primary" id="dodaj" name="dodaj">Dodaj</button>
		</form>
        <a href="unos.php">
		<center><button class="btn btn-primary mt-5 mb-2" name="nazad">NAZAD</button>
		</center>
	</a>

	</div>
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>