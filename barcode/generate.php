<?php
if (isset($_POST['generate'])) {
    $code = $_POST['barcode'];
    file_put_contents('C:\xampp\htdocs\dio\barcode\python\print\output.txt', $code);
    header("Location: print.php");
}

?>