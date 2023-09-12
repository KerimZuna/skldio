<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WMS - AutoTarget</title>
    <link href="login_styles.css?v=2" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

    <section class="vh-75 gradient-custom mt-2">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card text-black" style="border-radius: 1rem; background-color: #FBAD07;">
                        <div class="card-body text-center">

                            <div class="mb-md-5 pb-4 pt-4">

                                <div class="image-container"
                                    style="background-color:white; margin-bottom: 33px; border: 1px solid grey; border-radius: 10px">
                                    <img src="barcode/slike/logo.png" alt="Login Image"
                                        style="width:200px; height: 100%; padding-top:5px;padding-bottom:5px;">
                                </div>
                                <form action="login_logika.php" method="POST">
                                    <div class="form-outline form-white mb-4">
                                        <input type="text" name="korisnicko_ime" placeholder="Korisničko ime"
                                            class="form-control form-control-lg" />
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" name="sifra" placeholder="Šifra"
                                            class="form-control form-control-lg" />
                                    </div>

                                    <button class="btn btn-dark btn-lg px-5 text-white fw-bold col-12"
                                        type="submit">PRIJAVI
                                        SE</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>