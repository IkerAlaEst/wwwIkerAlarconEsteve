<?php
session_start();
include 'funcions.php';
// registra abans de destruir la sessió
if (isset($_SESSION['correuLogin'])) {
    registreAccionsUsuari("logout", $_SESSION['correuLogin'], "../log/accionsUsuari.log");
}
session_destroy();
unset($_SESSION);
header("Location: ../index.php");
die();
?>