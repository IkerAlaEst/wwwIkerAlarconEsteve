<?php
    include_once 'entity/CredencialsBD.php';
    function registreApartat(string $apartat, string $ruta): void {
        $apartat = strtoupper($apartat);
        $dia = date("d/m/Y");
        $hora = date("H:i:s");
        $dir = dirname($ruta);
        if (!file_exists($dir)) mkdir($dir, 0777, true);
        $nombreLinea = file_exists($ruta) ? count(file($ruta)) + 1 : 1;
        $text = "$nombreLinea :: Accés a l'apartat $apartat el dia $dia a l'hora $hora".PHP_EOL;
        if ($fitxer = fopen($ruta, 'a')) {
            fwrite($fitxer, $text);
            fclose($fitxer);
            if ($nombreLinea % 10 == 0) {
                $dirBackup = "$dir/backup";
                if (!file_exists($dirBackup)) mkdir($dirBackup, 0777, true);
                $rutaBackup = "$dirBackup/backup_".date("dmY_His").".log";
                copy($ruta, $rutaBackup);
            }
        }
    }

    function registreAccionsUsuari(string $accio, string $usuari, string $fitxer): void {
        $accio = strtoupper($accio);
        $dia = date("d/m/Y");
        $hora = date("H:i:s");
        $dir = dirname($fitxer);
        if (!file_exists($dir)) mkdir($dir, 0777, true);
        $text = "L'usuari $usuari ha realitzat l'acció $accio el dia $dia a l'hora $hora".PHP_EOL;
        if ($fitxerObrir = fopen($fitxer, 'a')) {
            fwrite($fitxerObrir, $text);
            fclose($fitxerObrir);
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
        $servidorBd = CredencialsBD::SERVIDOR;
        $usuariBd = CredencialsBD::USUARI;
        $contrasenyaBd = CredencialsBD::CONTRASENYA;
        $nomBase = CredencialsBD::BASEDADES;
        if (usuariExisteix($correu)) return "usuariExisteix";
        $connexioBd = mysqli_connect($servidorBd, $usuariBd, $contrasenyaBd, $nomBase);
        if (!$connexioBd) return "error";
        $hash = password_hash($contrasenya, PASSWORD_DEFAULT);
        if ($cognoms !== "") {
            $sql = "INSERT INTO usuari (nom,cognoms,correu,contrasenya) VALUES ('$nom','$cognoms','$correu','$hash')";
        } else {
            $sql = "INSERT INTO usuari (nom,correu,contrasenya) VALUES ('$nom','$correu','$hash')";
        }
        $resultatConsulta = mysqli_query($connexioBd, $sql);
        mysqli_close($connexioBd);
        return $resultatConsulta ? "usuariInserit" : "error";
    }

    function usuariExisteix(string $correu) : bool {
        $servidorBd = CredencialsBD::SERVIDOR;
        $usuariBd = CredencialsBD::USUARI;
        $contrasenyaBd = CredencialsBD::CONTRASENYA;
        $nomBase = CredencialsBD::BASEDADES;
        $connexioBd = mysqli_connect($servidorBd, $usuariBd, $contrasenyaBd, $nomBase);
        if (!$connexioBd) return false;
        $sql = "SELECT 1 FROM usuari WHERE correu='$correu'";
        $resultat = mysqli_query($connexioBd, $sql);
        $exists = $resultat && mysqli_num_rows($resultat) > 0;
        mysqli_close($connexioBd);
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

    function mostraFormulariAnimal(int $id): void {
        $idForm = (int)$id;
        echo '<form id="formulariAnimal'.$idForm.'" name="formulariAnimal'.$idForm.'" action="index.php?apartat=apadrina" method="POST">'
           . '<input type="hidden" name="idAnimal" value="'.$idForm.'">'
           . '<div><span><label for="quantitatAnimal'.$idForm.'">Quantitat:</label></span>'
           . '<span><input id="quantitatAnimal'.$idForm.'" name="quantitatAnimal" type="number" min="0" step="1"></span></div>'
           . '<div><span><button id="enviaFormulariAnimal'.$idForm.'" name="envia" type="submit">Afegeix al carret</button></span></div>'
           . '</form>';
    }

    function mostraAnimals(): void {
        $servidorBd = CredencialsBD::SERVIDOR;
        $usuariBd = CredencialsBD::USUARI;
        $contrasenyaBd = CredencialsBD::CONTRASENYA;
        $nomBase = CredencialsBD::BASEDADES;
        $connexioBd = mysqli_connect($servidorBd, $usuariBd, $contrasenyaBd, $nomBase);
        if (!$connexioBd) {
            echo "<p>Error connexió base</p>";
            return;
        }
        $sql = "SELECT * FROM animal";
        $resultat = mysqli_query($connexioBd, $sql);
        if ($resultat && mysqli_num_rows($resultat) > 0) {
            echo '<div class="animal-grid">';
            while ($row = mysqli_fetch_assoc($resultat)) {
                echo '<div class="animal-card">';
                echo '<h3>'.htmlspecialchars($row['nom_comu']).' (<em>'.htmlspecialchars($row['nom_cientific']).'</em>)</h3>';
                $imatge = $row['imatge'] ?: 'animalDefecte.png';
                echo '<img src="img/apadrina/'.htmlspecialchars($imatge).'" alt="'.htmlspecialchars($row['nom_comu']).'" style="max-width:150px;">';
                if ($row['descripcio']) echo '<p>'.nl2br(htmlspecialchars($row['descripcio'])).'</p>';
                echo '<p>Donació: '.htmlspecialchars($row['donacio']).' €</p>';
                echo '<p>Apadrinats: '.htmlspecialchars($row['quantitat']).'</p>';
                echo '<p>Afegit el: '.htmlspecialchars($row['data_afegit']).'</p>';
                mostraFormulariAnimal($row['id']);
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p>No hi ha animals disponibles.</p>';
        }
        mysqli_close($connexioBd);
    }