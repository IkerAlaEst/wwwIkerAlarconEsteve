<?php
session_start();
include 'funcions.php';
if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    die();
}
if (!isset($_GET['id'])) {
    header("Location: ../index.php?accioadmin=errorbasedades");
    die();
}
$id = intval($_GET['id']);
$servidorBd = CredencialsBD::SERVIDOR;
$usuariBd = CredencialsBD::USUARI;
$contrasenyaBd = CredencialsBD::CONTRASENYA;
$nomBase = CredencialsBD::BASEDADES;
$connexioBd = new mysqli($servidorBd, $usuariBd, $contrasenyaBd, $nomBase);
if ($connexioBd->connect_error) {
    header("Location: ../index.php?accioadmin=errorbasedades");
    die();
}
// recollir dades de l'usuari per registrar
$emailUsuari = '';
$sel = "SELECT correu FROM usuari WHERE id = $id";
$resSel = $connexioBd->query($sel);
if ($resSel && $resSel->num_rows > 0) {
    $row = $resSel->fetch_assoc();
    $emailUsuari = $row['correu'];
}
$sql = "DELETE FROM `usuari` WHERE `id` = $id";
if ($connexioBd->query($sql) === TRUE) {
    // registre eliminació
    if ($emailUsuari !== '') {
        registreAccionsUsuari("eliminació usuari", $emailUsuari, "../log/accionsUsuari.log");
    }
    header("Location: ../index.php?accioadmin=eliminat");
} else {
    header("Location: ../index.php?accioadmin=errorbasedades");
}
$connexioBd->close();
die();
?>