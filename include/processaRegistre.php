<?php
    include 'funcions.php';
    include 'partials/calcularData.partial.php';
    include 'partials/dadesAnimals.partial.php';

    const BUIT = '<span class="vacio">*Valor Buit*</span>';
    
    // Dades processat:
    $color = 'normal';
    if (isset($_POST['color'])) $color = trim(htmlspecialchars($_POST['color']));
    
    $nom = '';
    if (isset($_POST['nom'])) $nom = trim(htmlspecialchars($_POST['nom']));
    $cognoms = '';
    if (isset($_POST['cognoms'])) $cognoms = trim(htmlspecialchars($_POST['cognoms']));
    $adreça = '';
    if (isset($_POST['adreça'])) $adreça = trim(htmlspecialchars($_POST['adreça']));
    $correuElectronic = '';
    if (isset($_POST['correuElectronic'])) {
        $correuElectronic = trim(htmlspecialchars($_POST['correuElectronic']));
        registreAccionsUsuari("registre", $correuElectronic, "../log/accionsUsuari.log");
    }
    $contrasenya = '';
    if (isset($_POST['contrasenya'])) $contrasenya = trim(htmlspecialchars($_POST['contrasenya']));
    $telefon = '';
    if (isset($_POST['telefon'])) $telefon = trim(htmlspecialchars($_POST['telefon']));
    $donacio = '';
    if (isset($_POST['donacio'])) $donacio = trim(htmlspecialchars($_POST['donacio']));
    $animal = 'avatarAnimalDefault';
    if (isset($_POST['animal']) && strcmp($_POST['animal'],'') != 0) $animal = trim(htmlspecialchars($_POST['animal']));
    $imatgeAnimal = '../img/avatarAnimalDefault.png';
    switch ($animal) {
        case 'goril·la':
            $imatgeAnimal = '../img/gorilla.jpg';
            break;
        case 'tortuga':
            $imatgeAnimal = '../img/tortuga.jpg';
            break;
        case 'tigre':
            $imatgeAnimal = '../img/tigre.jpg';
            break;
        case 'rinoceront':
            $imatgeAnimal = '../img/rinoceront.jpg';
            break;
        case 'orangutan':
            $imatgeAnimal = '../img/orangutan.jpg';
            break;
    }
    $continent = '';
    if (isset($_POST['continent'])) $continent = trim(htmlspecialchars($_POST['continent']));
    $puntuacio = 1;
    if (isset($_POST['puntuacio'])) $puntuacio = $_POST['puntuacio'];
    $estrella = '';
    switch ($puntuacio) {
        case 1:
            $estrella = '../img/estrella-roja.png';
            break;
        case 2:
            $estrella = '../img/estrella-naranja.png';
            break;
        case 3:
            $estrella = '../img/estrella-amarilla.png';
            break;
        case 4:
            $estrella = '../img/estrella-verde.png';
            break;
        case 5:
            $estrella = '../img/estrella-brillante.webp';
            break;
    }
    $multiplicador = 1;
    if (isset($_POST['multiplicador'])) $multiplicador = $_POST['multiplicador'];
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
        include "partials/menu.partial.php";
        include "partials/processaRegistre.partial.php";
        include "partials/peu.partial.php";
    ?>
</body>
</html>