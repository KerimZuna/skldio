<?php
if (isset($_POST['print'])) {
    $imageFile = $_POST['imageFile']; // Path to the generated image

    // Check if the file exists
    if (file_exists($imageFile)) {
        // Define the printer name or network address
        $printer = "YOUR_PRINTER_NAME_OR_IP_ADDRESS";

        // Use the copy function to send the image to the printer
        copy($imageFile, "smb://{$printer}/"); // You may need to adjust the URL scheme for your printer

        echo "Image sent to the printer for printing.";
    } else {
        echo "Image file not found.";
    }
}
?>
