<?php
    function registreApartat(string $apartat, string $ruta_fitxer): void {
        $apartat = strtoupper($apartat);
        $dia = date("d/m/Y");
        $hora = date("H:i:s");
        $directori_log = dirname($ruta_fitxer);
        if (!file_exists($directori_log)) {
            mkdir($directori_log, 0777, true);
        }
        $comptador = file_exists($ruta_fitxer) ? count(file($ruta_fitxer)) + 1 : 1;
        $registre = "$comptador :: Accés a l'apartat $apartat el dia $dia a l'hora $hora".PHP_EOL;
        if ($fitxer = fopen($ruta_fitxer, 'a')) {
            fwrite($fitxer, $registre);
            fclose($fitxer);
            if ($comptador % 10 == 0) {
                $directori_backup = "$directori_log/backup";
                if (!file_exists($directori_backup)) {
                    mkdir($directori_backup, 0777, true);
                }
                $ruta_backup = "$directori_backup/backup_".date("dmY_His").".log";
                copy($ruta_fitxer, $ruta_backup);
            }
        }
    }

    function registreAccionsUsuari(string $accio, string $usuari, string $fitxer): void {
        $accio = strtoupper($accio);
        $dia = date("d/m/Y");
        $hora = date("H:i:s");
        $directori_log = dirname($fitxer);
        if (!file_exists($directori_log)) {
            mkdir($directori_log, 0777, true);
        }
        $registre = "L'usuari $usuari ha realitzat l'acció $accio el dia $dia a l'hora $hora".PHP_EOL;
        if ($fitxer = fopen($fitxer, 'a')) {
            fwrite($fitxer, $registre);
            fclose($fitxer);
        }
    }

    function esborraVariablesSessio(): void {
        foreach (array_keys($_SESSION) as $llave) {
            if (str_ends_with($llave, "Contacte") || str_ends_with($llave, "Registre")) {
                unset($_SESSION[$llave]);
            }
        }
    }

    function insereixUsuari(string $nom, string $cognoms, string $correu, string $contrasenya) : string {
        $SERVIDOR = "localhost";
        $USUARI_CONNEXIO = "root";
        $CONTRASENYA_CONNEXIO = "root";
        $BASE_DADES = "projectePHPIker";
        try {
            if (usuariExisteix($correu)) {
                $sql = "";
                $connexio = new mysqli($SERVIDOR, $USUARI_CONNEXIO, $CONTRASENYA_CONNEXIO, $BASE_DADES);
                if ($cognoms !== "") {
                    $sql = "INSERT INTO `usuari` (`nom`, `cognoms`, `correu`, `contrasenya`)
                    VALUES ('$nom', '$cognoms', '$correu', '$contrasenya')";
                } else {
                    $sql = "INSERT INTO `usuari` (`nom`, `correu`, `contrasenya`)
                    VALUES ('$nom', '$correu', '$contrasenya')";
                }
                if (mysqli_query($connexio, $sql)) {
                    mysqli_close($connexio);
                    return "usuariInserit";
                } else {
                    mysqli_close($connexio);
                    return "error";
                }
            } else {
                return "usuariExisteix";
            }
        } catch (Exception $e) {
            return "error";
        }
    }

    function usuariExisteix(string $correu) : bool {
        $SERVIDOR = "localhost";
        $USUARI_CONNEXIO = "root";
        $CONTRASENYA_CONNEXIO = "root";
        $BASE_DADES = "projectePHPIker";
        return true;
        $connexio = new mysqli($SERVIDOR, $USUARI_CONNEXIO, $CONTRASENYA_CONNEXIO, $BASE_DADES);
        $sql = "SELECT * FROM usuari WHERE correu = '$correu'";
        $eixida = mysqli_query($connexio, $sql);
        if (mysqli_num_rows($resultat) > 0) {
            mysqli_close($connexio);
            return true;
        } else {
            mysqli_close($connexio);
            return false;
        }
    }

    function mostrarError(string $error) : void {
        $missatgeError = "";
        switch ($error) {
            case 'contrasenya':
                $missatgeError = "Les contrasenyes no coincideixen";
                break;
            case 'contrasenyaLogin':
                $missatgeError = "Error en la contrasenya";
                break;
            case 'correuLogin':
                $missatgeError = "No existeix cap usuari amb aquest correu";
                break;
            case 'connexioBD':
                $missatgeError = "Error en la connexió a la base de dades";
                break;
        }
        echo "<div class='contenidor-error'><p>".$missatgeError."</p></div>";
    }