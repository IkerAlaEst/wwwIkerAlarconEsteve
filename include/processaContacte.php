<?php
    session_start();
    include 'funcions.php';
    include 'partials/calcularData.partial.php';

    const BUIT = '<span class="vacio">*Valor Buit*</span>';

    $color = 'normal';
    if (isset($_SESSION["color"])) {
        $color = $_SESSION["color"];
    }
    if (isset($_POST['color'])) {
        $color = trim(htmlspecialchars($_POST['color']));
        $_SESSION["color"] = $color;
    }

    $error = '';
    if (isset($_GET['error'])) {
        $error = trim(htmlspecialchars($_GET['error']));
    }

    // Dades processat:
    $correuElectronic = '';
    if (isset($_SESSION["correuElectronicContacte"])) {
        $correuElectronic = $_SESSION["correuElectronicContacte"];
    }
    if (isset($_POST['correuElectronic'])) {
        $correuElectronic = trim(htmlspecialchars($_POST['correuElectronic']));
        $_SESSION["correuElectronicContacte"] = $correuElectronic;
        registreAccionsUsuari("contacte", $correuElectronic, "../log/accionsUsuari.log");
    }
    $assumpte = '';
    if (isset($_SESSION["assumpteContacte"])) {
        $assumpte = $_SESSION["assumpteContacte"];
    }
    if (isset($_POST['assumpte'])) {
        $assumpte = trim(htmlspecialchars($_POST['assumpte']));
        $_SESSION["assumpteContacte"] = $assumpte;
    }
    $missatge = '';
    if (isset($_SESSION["missatgeContacte"])) {
        $missatge = $_SESSION["missatgeContacte"];
    }
    if (isset($_POST['missatge'])) {
        $missatge = trim(htmlspecialchars($_POST['missatge']));
        $_SESSION["missatgeContacte"] = $missatge;
    }
    $missatgeExplotat = explode(' ', $missatge);
    $missatgeSeparat = array();
    for ($i=0, $j=0; $i < count($missatgeExplotat); $i++) { 
        if (trim($missatgeExplotat[$i] !== '')) {
            $missatgeSeparat[$j] = trim($missatgeExplotat[$i]);
            $j++;
        }
    }
    $llongitud = 0;
    if (count($missatgeSeparat) > 0) {
        $llongitud = count($missatgeSeparat);
    }

    // Bloc login
    $correuLogin = '';
    if (isset($_SESSION["correuLogin"])) {
        $correuLogin = $_SESSION["correuLogin"];
    }
    $nomLogin = '';
    if (isset($_SESSION["nomLogin"])) {
        $nomLogin = $_SESSION["nomLogin"];
    }
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apadrina un animal</title>
    <link rel="stylesheet" href="../css/estils.css">
    <?php
        if ($color != null && $color != 'normal') {
            echo '<link rel="stylesheet" href="../css/estils'.$color.'.css">';
        }
    ?>
</head>
<body>
    <?php
        include "partials/cap.partial.php";
        if ($correuLogin === '') {
            include "partials/login.partial.php";
        }
        include "partials/menu.partial.php";
        include "partials/processaContacte.partial.php";
        include "partials/peu.partial.php";
    ?>
</body>
</html>