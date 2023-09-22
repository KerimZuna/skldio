<?php
require 'vendor/autoload.php'; // Include Composer's autoloader

// Product information to encode
$productInfo = "12345"; // Replace with your product information

// Generate the barcode image and save it as a file
$barcodeOptions = array(
    'text' => $productInfo,
);
$rendererOptions = array(
    'imageType' => 'png',
    'imagePath' => 'product_barcode.png',
);

$barcode = Zend\Barcode\Barcode::factory('code39', 'image', $barcodeOptions, $rendererOptions);
$barcode->render();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Barcode</title>
</head>
<body>
    <h1>Barcode</h1>
    <p>Barcode for product:</p>
    <!-- Display the barcode image on the web page -->
    <img src="product_barcode.png" alt="Product Barcode">
</body>
</html>
