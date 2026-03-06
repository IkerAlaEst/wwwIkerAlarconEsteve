<?php
    session_start();
    include 'funcions.php';
    include 'funcionsAdmin.php';
    include 'partials/calcularData.partial.php';
    include 'partials/dadesAnimals.partial.php';

    const BUIT = '<span class="vacio">*Valor Buit*</span>';

    $error = '';
    if (isset($_GET['error'])) {
        $error = trim(htmlspecialchars($_GET['error']));
    }
    
    // Dades processat:
    $color = 'normal';
    if (isset($_SESSION["color"])) {
        $color = $_SESSION["color"];
    }
    if (isset($_POST['color'])) {
        $color = trim(htmlspecialchars($_POST['color']));
        $_SESSION["color"] = $color;
    }
    $nom = '';
    if (isset($_SESSION["nomRegistre"])) {
        $nom = $_SESSION["nomRegistre"];
    }
    if (isset($_POST['nom'])) {
        $nom = trim(htmlspecialchars($_POST['nom']));
        $_SESSION["nomRegistre"] = $nom;
    }
    $cognoms = '';
    if (isset($_SESSION["cognomsRegistre"])) {
        $cognoms = $_SESSION["cognomsRegistre"];
    }
    if (isset($_POST['cognoms'])) {
        $cognoms = trim(htmlspecialchars($_POST['cognoms']));
        $_SESSION["cognomsRegistre"] = $cognoms;
    }
    $adreça = '';
    if (isset($_SESSION["adreçaRegistre"])) {
        $adreça = $_SESSION["adreçaRegistre"];
    }
    if (isset($_POST['adreça'])) {
        $adreça = trim(htmlspecialchars($_POST['adreça']));
        $_SESSION["adreçaRegistre"] = $adreça;
    }
    $correuElectronic = '';
    if (isset($_SESSION["correuElectronicRegistre"])) {
        $correuElectronic = $_SESSION["correuElectronicRegistre"];
    }
    if (isset($_POST['correuElectronic'])) {
        $correuElectronic = trim(htmlspecialchars($_POST['correuElectronic']));
        $_SESSION["correuElectronicRegistre"] = $correuElectronic;
        registreAccionsUsuari("registre", $correuElectronic, "../log/accionsUsuari.log");
    }
    $contrasenya = '';
    if (isset($_SESSION["contrasenyaRegistre"])) {
        $contrasenya = $_SESSION["contrasenyaRegistre"];
    }
    if (isset($_POST['contrasenya'])) {
        $contrasenya = trim(htmlspecialchars($_POST['contrasenya']));
        $_SESSION["contrasenyaRegistre"] = $contrasenya;
    }
    $confirmaContrasenya = '';
    if (isset($_SESSION["confirmaContrasenyaRegistre"])) {
        $confirmaContrasenya = $_SESSION["confirmaContrasenyaRegistre"];
    }
    if (isset($_POST['confirmaContrasenya'])) {
        $confirmaContrasenya = trim(htmlspecialchars($_POST['confirmaContrasenya']));
        $_SESSION["confirmaContrasenyaRegistre"] = $confirmaContrasenya;
    }
    if (strcmp($contrasenya, $confirmaContrasenya) !== 0) {
        header("Location: ../index.php?apartat=registre&error=contrasenya");
        die();
    }
    $telefon = '';
    if (isset($_SESSION["telefonRegistre"])) {
        $telefon = $_SESSION["telefonRegistre"];
    }
    if (isset($_POST['telefon'])) {
        $telefon = trim(htmlspecialchars($_POST['telefon']));
        $_SESSION["telefonRegistre"] = $telefon;
    }
    $donacio = '';
    if (isset($_SESSION["donacioRegistre"])) {
        $donacio = $_SESSION["donacioRegistre"];
    }
    if (isset($_POST['donacio'])) {
        $donacio = trim(htmlspecialchars($_POST['donacio']));
        $_SESSION["donacioRegistre"] = $donacio;
    }
    $animal = 'avatarAnimalDefault';
    if (isset($_SESSION["animalRegistre"])) {
        $animal = $_SESSION["animalRegistre"];
    }
    if (isset($_POST['animal']) && $_POST['animal'] !== '') {
        $animal = trim(htmlspecialchars($_POST['animal']));
        $_SESSION["animalRegistre"] = $animal;
    }
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
    if (isset($_SESSION["continent"])) {
        $continent = $_SESSION["continent"];
    }
    if (isset($_POST['continent'])) {
        $continent = trim(htmlspecialchars($_POST['continent']));
        $_SESSION["continent"] = $continent;
    }
    $puntuacio = 1;
    if (isset($_SESSION["puntuacio"])) {
        $puntuacio = $_SESSION["puntuacio"];
    }
    if (isset($_POST['puntuacio'])) {
        $puntuacio = (int) $_POST['puntuacio'];
        $_SESSION["puntuacio"] = $puntuacio;
    }
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
    if (isset($_SESSION["multiplicadorRegistre"])) {
        $multiplicador = $_SESSION["multiplicadorRegistre"];
    }
    if (isset($_POST['multiplicador'])) {
        $multiplicador = $_POST['multiplicador'];
        $_SESSION["multiplicadorRegistre"] = $multiplicador;
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
        if (!isset($_SESSION['admin'])) {
            include "partials/menu.partial.php";
        }
        if (isset($_SESSION['admin'])) {
            gestionaUsuaris();
        } else {
            include "partials/processaRegistre.partial.php";
        }
        include "partials/carret.partial.php";
        include "partials/peu.partial.php";
    ?>
</body>
</html>