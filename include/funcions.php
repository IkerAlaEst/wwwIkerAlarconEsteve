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
                $hashedPassword = password_hash($contrasenya, PASSWORD_DEFAULT);
                if ($cognoms !== "") {
                    $sql = "INSERT INTO `usuari` (`nom`, `cognoms`, `correu`, `contrasenya`)
                    VALUES ('$nom', '$cognoms', '$correu', '$hashedPassword')";
                } else {
                    $sql = "INSERT INTO `usuari` (`nom`, `correu`, `contrasenya`)
                    VALUES ('$nom', '$correu', '$hashedPassword')";
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
        $connexio = new mysqli($SERVIDOR, $USUARI_CONNEXIO, $CONTRASENYA_CONNEXIO, $BASE_DADES);
        if ($connexio->connect_error) {
            return false;
        }
        $sql = "SELECT * FROM usuari WHERE correu = '$correu'";
        $resultat = mysqli_query($connexio, $sql);
        $exists = (mysqli_num_rows($resultat) > 0);
        mysqli_close($connexio);
        return $exists;
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

    // ------------------------------------------------------------------
    // funcions relacionades amb la taula d'animals
    function mostraFormulariAnimal(int $id): void {
        // crea un formulari per afegir una quantitat de l'animal al carret
        $formId = 'formulariAnimal'.$id;
        echo '<form id="'.$formId.'" name="'.$formId.'" action="index.php?apartat=apadrina" method="POST">';
        echo '<input type="hidden" name="idAnimal" value="'.$id.'">';
        echo '<div><span><label for="quantitatAnimal'.$id.'">Quantitat:</label></span>';
        echo '<span><input id="quantitatAnimal'.$id.'" name="quantitatAnimal" type="number" min="0" step="1"></span></div>';
        echo '<div><span><button id="enviaFormulariAnimal'.$id.'" name="envia" type="submit">Afegeix al carret</button></span></div>';
        echo '</form>';
    }

    function mostraAnimals(): void {
        $SERVIDOR = "localhost";
        $USUARI_CONNEXIO = "root";
        $CONTRASENYA_CONNEXIO = "root";
        $BASE_DADES = "projectePHPIker";
        $connexio = new mysqli($SERVIDOR, $USUARI_CONNEXIO, $CONTRASENYA_CONNEXIO, $BASE_DADES);
        if ($connexio->connect_error) {
            echo "<p>Error en la connexió amb la base de dades.</p>";
            return;
        }
        $sql = "SELECT * FROM animal";
        $resultat = $connexio->query($sql);
        if ($resultat && $resultat->num_rows > 0) {
            echo '<div class="animal-grid">';
            while ($row = $resultat->fetch_assoc()) {
                echo '<div class="animal-card">';
                echo '<h3>'.htmlspecialchars($row['nom_comu']).' (<em>'.htmlspecialchars($row['nom_cientific']).'</em>)</h3>';
                $img = $row['imatge'] !== '' ? $row['imatge'] : 'animalDefecte.png';
                echo '<img src="img/apadrina/'.htmlspecialchars($img).'" alt="'.htmlspecialchars($row['nom_comu']).'" style="max-width:150px;">';
                if ($row['descripcio'] !== '') {
                    echo '<p>'.nl2br(htmlspecialchars($row['descripcio'])).'</p>';
                }
                echo '<p>Donació: '.htmlspecialchars($row['donacio']).' €</p>';
                echo '<p>Apadrinats: '.htmlspecialchars($row['quantitat']).'</p>';
                echo '<p>Afegit el: '.htmlspecialchars($row['data_afegit']).'</p>';
                // formulari per a aquest animal
                mostraFormulariAnimal($row['id']);
                echo '</div>';
            }
            echo '</div>'; // close grid
        } else {
            echo '<p>No hi ha animals disponibles.</p>';
        }
        $connexio->close();
    }