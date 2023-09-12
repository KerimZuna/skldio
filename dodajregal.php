<?php
include 'conn.php';

if (isset($_POST['dodaj']) && isset($_POST['broj'])) {
    $broj = $_POST['broj'];
    $lokacija = 'Garaža';

    for ($i = 1; $i <= $broj; $i++) {
        $sql = "INSERT INTO regali (lokacija) VALUES ('$lokacija')";

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            break; // Exit the loop if there's an error in one iteration
        }

        $code = $last_id;

        $img_url = "http://localhost/dio/barcode/barcode.php?codetype=Code39&size=50&text=" . $code . "&print=true";
        echo '<img src=barcode/barcode.php?codetype=Code39&size=50&text=" . $code . "&print=true">';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $img_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $image_content = curl_exec($ch);

        curl_close($ch);

        if ($image_content !== false) {
            $image_path = "barcode/slike/regali/" . $code . ".png";

            if (file_put_contents($image_path, $image_content) !== false) {
            } else {
                echo "Failed to save the image.";
            }
        } else {
            echo "Failed to fetch the image content from the URL: $img_url";
        }
    }
    header("Location: regal.php");
}
    
?>
