<?php
    $action = $_SERVER['PHP_SELF'];
    if (isset($_GET['apartat'])) {
        $action .= '?apartat='.$_GET['apartat'];
    }
?>

<header class="contenidor-principal">
    <div class="contenidor-roig">
        <h1>Apadrina un animal en perill d'extinció</h1>
    </div>
    <div class="contenidor-horitzontal">
        <div class="contenidor-blau">
            <label><strong>CSS:</strong></label>
            <form action="<?php echo $action; ?>" method="post">
                <label><input type="radio" name="color" value="Roig">Roig</label>
                <label><input type="radio" name="color" value="Marro">Marró</label>
                <input type="radio" name="color" value="normal" checked hidden>
                <input type="submit" value="Canvia">
            </form>
        </div>
        <div class="contenidor-blau">
            <h3>
                <?php
                    echo $data;
                ?>
            </h3>
        </div>
    </div>
</header>