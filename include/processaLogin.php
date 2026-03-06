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
        $servidorBd = CredencialsBD::SERVIDOR;
        $usuariBd = CredencialsBD::USUARI;
        $contrasenyaBd = CredencialsBD::CONTRASENYA;
        $nomBase = CredencialsBD::BASEDADES;
        try {
            $connexioBd = new mysqli($servidorBd, $usuariBd, $contrasenyaBd, $nomBase);
            $sql = "SELECT * FROM usuari WHERE correu = '$correu'";
            $resultat = mysqli_query($connexioBd, $sql);
            if (mysqli_num_rows($resultat) > 0) {
                while ($fila = mysqli_fetch_assoc($resultat)) {
                    if (password_verify($contrasenya, $fila["contrasenya"])) {
                        mysqli_close($connexioBd);
                        $_SESSION["correuLogin"] = $correu;
                        $_SESSION["contrasenyaLogin"] = $contrasenya;
                        $_SESSION["nomLogin"] = $fila["nom"];
                        if ($correu == 'admin@daw.com') {
                            $_SESSION['admin'] = true;
                        }
                        registreAccionsUsuari("login correcte", $correu, "../log/accionsUsuari.log");
                        header("Location: ../index.php");
                        die();
                    } else {
                        mysqli_close($connexioBd);
                        registreAccionsUsuari("login incorrecte", $correu, "../log/accionsUsuari.log");
                        header("Location: ../index.php?error=contrasenyaLogin");
                        die();
                    }
                }
            } else {
                mysqli_close($connexioBd);
                registreAccionsUsuari("login incorrecte", $correu, "../log/accionsUsuari.log");
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