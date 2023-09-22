<<<<<<< HEAD
<?php
if (isset($_POST['generate'])) {
    $code = $_POST['barcode'];
    file_put_contents('C:\xampp\htdocs\dio\barcode\python\print\output.txt', $code);
    header("Location: print.php");
    }

?>
=======
<?php
if (isset($_POST['generate'])) {
    $code = $_POST['barcode'];
    file_put_contents('C:\xampp\htdocs\dio\barcode\python\print\output.txt', $code);
    $printer = "192.168.0.195";
    $command = 'python C:\xampp\htdocs\dio\barcode\python\print\printaj.py';

    exec($command);
    header("Location: index.php");
    }

?>
>>>>>>> 0ce7764a707c14f33bc28774473029c971784320
