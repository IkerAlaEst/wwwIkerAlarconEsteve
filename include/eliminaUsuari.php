<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    die();
}
if (!isset($_GET['id'])) {
    header("Location: ../index.php?accioadmin=errorbasedades");
    die();
}
$id = intval($_GET['id']);
$SERVIDOR = "localhost";
$USUARI_CONNEXIO = "root";
$CONTRASENYA_CONNEXIO = "root";
$BASE_DADES = "projectePHPIker";
$connexio = new mysqli($SERVIDOR, $USUARI_CONNEXIO, $CONTRASENYA_CONNEXIO, $BASE_DADES);
if ($connexio->connect_error) {
    header("Location: ../index.php?accioadmin=errorbasedades");
    die();
}
$sql = "DELETE FROM `usuari` WHERE `id` = $id";
if ($connexio->query($sql) === TRUE) {
    header("Location: ../index.php?accioadmin=eliminat");
} else {
    header("Location: ../index.php?accioadmin=errorbasedades");
}
$connexio->close();
die();
?>