<?php
function gestionaUsuaris() {
    $SERVIDOR = "localhost";
    $USUARI_CONNEXIO = "root";
    $CONTRASENYA_CONNEXIO = "root";
    $BASE_DADES = "projectePHPIker";
    $connexio = new mysqli($SERVIDOR, $USUARI_CONNEXIO, $CONTRASENYA_CONNEXIO, $BASE_DADES);
    if ($connexio->connect_error) {
        die("Connexió fallida: " . $connexio->connect_error);
    }
    $sql = "SELECT `id`, `nom`, `correu`, `contrasenya` FROM `usuari`";
    $resultat = $connexio->query($sql);
    echo '<div class="contenidor-principal">';
    echo '<h2>Gestió d\'Usuaris</h2>';
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
    $connexio->close();
}
?>