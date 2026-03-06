<?php
include_once 'entity/CredencialsBD.php';
function gestionaUsuaris() {
    $servidorBd = CredencialsBD::SERVIDOR;
    // control de mostrar/o ocultar el log
    $mostrarLog = isset($_GET['mostrarLog']) && $_GET['mostrarLog'] === 'true';
    $usuariBd = CredencialsBD::USUARI;
    $contrasenyaBd = CredencialsBD::CONTRASENYA;
    $nomBase = CredencialsBD::BASEDADES;
    $connexioBd = new mysqli($servidorBd, $usuariBd, $contrasenyaBd, $nomBase);
    if ($connexioBd->connect_error) {
        die("Connexió fallida: " . $connexioBd->connect_error);
    }
    $sql = "SELECT `id`, `nom`, `correu`, `contrasenya` FROM `usuari`";
    $resultat = $connexioBd->query($sql);
    echo '<div class="contenidor-principal">';
    echo '<h2>Gestió d\'Usuaris</h2>';
    // enllaç per a mostrar/ocultar log
    $linkText = $mostrarLog ? 'Oculta Log' : 'Mostra Log';
    $linkParam = $mostrarLog ? 'false' : 'true';
    echo '<p><a href="index.php?mostrarLog='.$linkParam.'">'.$linkText.'</a></p>';
    if (isset($_GET['accioadmin'])) {
        if ($_GET['accioadmin'] == 'eliminat') {
            echo '<p style="color: green;">Usuari eliminat correctament.</p>';
        } elseif ($_GET['accioadmin'] == 'errorbasedades') {
            echo '<p style="color: red;">Error en la base de dades en eliminar l\'usuari.</p>';
        }
    }
    echo '<table border="1" style="width: 100%;">';
    echo '<tr><th>ID</th><th>Nom</th><th>Correu</th><th>Contrasenya</th><th>Acció</th></tr>';
    if ($resultat->num_rows > 0) {
        while ($row = $resultat->fetch_assoc()) {
            $style = ($row['correu'] == 'admin@daw.com') ? 'style="background-color: #f0f0f0;"' : '';
            echo '<tr ' . $style . '>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . htmlspecialchars($row['nom']) . '</td>';
            echo '<td>' . htmlspecialchars($row['correu']) . '</td>';
            echo '<td>' . htmlspecialchars(substr($row['contrasenya'], 0, 15) . '...') . '</td>';
            if ($row['correu'] != 'admin@daw.com') {
                echo '<td><a href="include/eliminaUsuari.php?id=' . $row['id'] . '">Eliminar</a></td>';
            } else {
                echo '<td></td>';
            }
            echo '</tr>';
        }
    }
    echo '</table>';
    echo '</div>';
    if ($mostrarLog) {
        mostraAccionsUsuari();
    }
    $connexioBd->close();
}

function mostraAccionsUsuari(): void {
    $ruta = __DIR__ . '/../log/accionsUsuari.log';
    if (!file_exists($ruta)) {
        echo '<p>No hi ha cap registre a mostrar.</p>';
        return;
    }
    $linies = file($ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    echo '<div class="contenidor-principal">';
    echo '<h3>Registre d\'accions</h3>';
    foreach ($linies as $linia) {
        $classe = '';
        if (str_contains($linia, 'LOGIN CORRECTE')) {
            $classe = 'log-login-ok';
        } elseif (str_contains($linia, 'LOGIN INCORRECTE')) {
            $classe = 'log-login-error';
        } elseif (str_contains($linia, 'LOGOUT')) {
            $classe = 'log-logout';
        } elseif (str_contains($linia, 'ELIMINACI')) {
            $classe = 'log-eliminacio';
        } elseif (str_contains($linia, 'REGISTRE')) {
            $classe = 'log-registre';
        } elseif (str_contains($linia, 'CONTACTE')) {
            $classe = 'log-contacte';
        }
        echo '<div class="'.$classe.'">'.htmlspecialchars($linia).'</div>';
    }
    echo '</div>';
}
?>