<?php
session_start();
include 'funcions.php';
if (isset($_SESSION['correuLogin'])) {
    registreAccionsUsuari("logout", $_SESSION['correuLogin'], "../log/accionsUsuari.log");
}
session_destroy();
unset($_SESSION);
header("Location: ../index.php");
die();
?>