<?php
if (isset($_SESSION['idAnimal']) && isset($_SESSION['quantitatAnimal'])) {
    $servidorBd = CredencialsBD::SERVIDOR;
    $usuariBd = CredencialsBD::USUARI;
    $contrasenyaBd = CredencialsBD::CONTRASENYA;
    $nomBase = CredencialsBD::BASEDADES;
    $connexioBd = new mysqli($servidorBd, $usuariBd, $contrasenyaBd, $nomBase);
    if ($connexio->connect_error) {
        echo "<div class='carret'><p>Error en la connexió amb la base de dades.</p></div>";
        return;
    }
    $id = (int) $_SESSION['idAnimal'];
    $sql = "SELECT * FROM `animal` WHERE `id` = $id";
    $resultat = $connexio->query($sql);
    if ($resultat && $resultat->num_rows > 0) {
        $row = $resultat->fetch_assoc();
        $nom = htmlspecialchars($row['nom_comu']);
        $donacio = (float) $row['donacio'];
        $quantitat = (int) $_SESSION['quantitatAnimal'];
        $total = $quantitat * $donacio;
        echo "<div class='carret'>";
        echo "<h4>Carret</h4>";
        echo "<p>ID: $id</p>";
        echo "<p>Nom: $nom</p>";
        echo "<p>Quantitat: $quantitat</p>";
        echo "<p>Donació total: " . number_format($total, 2) . " €</p>";
        echo "</div>";
    } else {
        echo "<div class='carret'><p>Animal no trobat.</p></div>";
    }
    $connexio->close();
}
?>