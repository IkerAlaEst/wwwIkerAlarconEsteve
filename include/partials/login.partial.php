<div class="contenidor-principal">
    <?php
        $ruta = "";
        if (strcmp(basename($_SERVER['PHP_SELF']), "index.php") === 0) {
            $ruta = "include/";
        }
    ?>
    <form action="<?php echo $ruta; ?>processaLogin.php" method="POST">
        <fieldset class="contenidor-secundari" id="formulari-login">
            <legend>Login</legend>
            <label><strong>Correu:</strong></label>
            <input type="email" name="correu" required>
            <label><strong>Contrasenya:</strong></label>
            <input type="password" name="contrasenya" required>
            <button style="padding: 0.2rem;" type="submit"><strong>Login</strong></button>
        </fieldset>
        <?php
        if ($error === "contrasenyaLogin" || $error === "connexioBD" || $error === "correuLogin")
            mostrarError($error);
        ?>
    </form>
</div>