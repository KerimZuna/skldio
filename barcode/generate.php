<?php
if (isset($_POST['generate'])) {
    $code = $_POST['barcode'];

    // Construct the URL for the barcode image
    $img_url = "http://localhost/dio/barcode/barcode.php?codetype=Code39&size=50&text=".$code."&print=true";

	echo "<center><img alt='testing' src='barcode.php?codetype=Code39&size=50&text=".$code."&print=true'/></center>";
    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $img_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL session and capture the image content
    $image_content = curl_exec($ch);

    // Close the cURL session
    curl_close($ch);

    if ($image_content !== false) {
        // Define the file path where you want to save the image
        $image_path = "slike/".$code.".png"; // Replace with your desired file path and filename

        // Save the captured image content to the file
        if (file_put_contents($image_path, $image_content) !== false) {
            echo '<center class="mt-3">Uspješno generirano i sačuvano.</center>';
        } else {
            echo "Failed to save the image.";
        }
    } else {
        echo "Failed to fetch the image content from the URL: $img_url";
    }
}
?>
