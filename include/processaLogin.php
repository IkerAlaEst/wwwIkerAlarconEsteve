<?php
    session_start();
    include 'funcions.php';
    
    // Dades processat:
    $correu = '';
    if (isset($_SESSION["correuLogin"])) {
        $correu = $_SESSION["correuLogin"];
    }
    if (isset($_POST['correu'])) {
        $correu = trim(htmlspecialchars($_POST['correu']));
    }
    $contrasenya = '';
    if (isset($_SESSION["contrasenyaLogin"])) {
        $contrasenya = $_SESSION["contrasenyaLogin"];
    }
    if (isset($_POST['contrasenya'])) {
        $contrasenya = trim(htmlspecialchars($_POST['contrasenya']));
    }

    if (usuariExisteix($correu)) {
        $SERVIDOR = "localhost";
        $USUARI_CONNEXIO = "root";
        $CONTRASENYA_CONNEXIO = "root";
        $BASE_DADES = "projectePHPIker";
        try {
            $connexio = new mysqli($SERVIDOR, $USUARI_CONNEXIO, $CONTRASENYA_CONNEXIO, $BASE_DADES);
            $sql = "SELECT * FROM usuari WHERE correu = '$correu'";
            $resultat = mysqli_query($connexio, $sql);
            if (mysqli_num_rows($resultat) > 0) {
                while ($fila = mysqli_fetch_assoc($resultat)) {
                    if ($fila["contrasenya"] === $contrasenya) {
                        mysqli_close($connexio);
                        $_SESSION["correuLogin"] = $correu;
                        $_SESSION["contrasenyaLogin"] = $contrasenya;
                        $_SESSION["nomLogin"] = $fila["nom"];
                        if ($correu == 'admin@daw.com') {
                            $_SESSION['admin'] = true;
                        }
                        header("Location: ../index.php");
                        die();
                    } else {
                        mysqli_close($connexio);
                        header("Location: ../index.php?error=loginContrasenya");
                        die();
                    }
                }
            } else {
                mysqli_close($connexio);
                header("Location: ../index.php?error=correuLogin");
                die();
            }
        } catch (Exception $e) { 
            header("Location: ../index.php?error=connexioBD");
            die();
        }
    } else {
        header("Location: ../index.php?error=correuLogin");
        die();
    }