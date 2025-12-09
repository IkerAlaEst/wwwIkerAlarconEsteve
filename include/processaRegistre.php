<?php
    $color = 'normal';
    if (isset($_POST['color'])) $color = trim(htmlspecialchars($_POST['color']));
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apadrina un animal</title>
    <link rel="stylesheet" href="../css/estils.css">
</head>
<body>
    <div style="display: contents;" class="color-<?php echo $color?>">
    <?php
        include "partials/cap.partial.php";
        include "partials/menu.partial.php";
        include "partials/processaRegistre.partial.php";
        include "partials/peu.partial.php";
    ?>
    </div>
</body>
</html>