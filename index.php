<?php
    $apartat = "";
    if (isset($_GET['apartat'])) {
        $apartat = strtolower($_GET['apartat']);
    }
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apadrina un animal</title>
    <link rel="stylesheet" href="css/estils.css">
</head>
<body>
    <?php
        include "include/partials/cap.partial.php";
        include "include/partials/menu.partial.php";
        switch ($apartat) {
            case '':
                include "include/partials/inici.partial.php";
                break;
            case 'inici':
                include "include/partials/inici.partial.php";
                break;
            case 'registre':
                include "include/partials/registre.partial.php";
                break;
            case 'contacte':
                include "include/partials/contacte.partial.php";
                break;
            case 'apadrina':
                include "include/partials/apadrina.partial.php";
                break;
            default:
                include "include/partials/error.partial.php";
                break;
        }
        include "include/partials/peu.partial.php";
    ?>
</body>
</html>