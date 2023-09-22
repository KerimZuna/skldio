<?php
require 'qrcode/qrlib.php';

// Product information to encode
$productInfo = "Ime artikla: Far\nID Artikla: 52235\nLokacija: R624X";

// Generate QR code as a data URI
ob_start(); // Start output buffering
QRcode::png($productInfo, null, QR_ECLEVEL_L, 10); // Generate the QR code (note the null for output)
$qrCodeImage = ob_get_contents(); // Get the generated QR code image data
ob_end_clean(); // End output buffering

?>

<!DOCTYPE html>
<html>
<head>
    <title>QR Kod</title>
</head>
<body>
    <h1>QR Kod</h1>
    <img src="data:image/png;base64,<?php echo base64_encode($qrCodeImage); ?>" alt="Product QR Code">
</body>
</html>
