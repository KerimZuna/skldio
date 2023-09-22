<<<<<<< HEAD
<?php
session_start();

if (isset($_SESSION["user_id"])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
} else {
    header("Location: login.php");
    exit();
}
=======
<?php
session_start();

if (isset($_SESSION["user_id"])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
} else {
    header("Location: login.php");
    exit();
}
>>>>>>> 0ce7764a707c14f33bc28774473029c971784320
?>