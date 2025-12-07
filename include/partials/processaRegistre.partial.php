<?php
    $nom = '';
    if (isset($_POST['nom'])) $nom = trim(htmlspecialchars($_POST['nom']));
    $cognoms = '';
    if (isset($_POST['cognoms'])) $cognoms = trim(htmlspecialchars($_POST['cognoms']));
    $adreça = '';
    if (isset($_POST['adreça'])) $adreça = trim(htmlspecialchars($_POST['adreça']));
    $correuElectronic = '';
    if (isset($_POST['correuElectronic'])) $correuElectronic = trim(htmlspecialchars($_POST['correuElectronic']));
    $contrasenya = '';
    if (isset($_POST['contrasenya'])) $contrasenya = trim(htmlspecialchars($_POST['contrasenya']));
    $telefon = '';
    if (isset($_POST['telefon'])) $telefon = trim(htmlspecialchars($_POST['telefon']));
    $donacio = '';
    if (isset($_POST['donacio'])) $donacio = trim(htmlspecialchars($_POST['donacio']));
    $continent = '';
    if (isset($_POST['continent'])) $continent = trim(htmlspecialchars($_POST['continent']));
?>

<header class="contenidor-principal">
    <div class="contenidor-secundari">
        <div class="contenidor-titol">
            <h2>Registre</h2>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Nom: </span><span class="valor-campo"><?php echo ($nom == '' ? 'Valor Buit' : $nom) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Cognoms: </span><span class="valor-campo"><?php echo ($cognoms == '' ? 'Valor Buit' : $cognoms) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Adreça: </span><span class="valor-campo"><?php echo ($adreça == '' ? 'Valor Buit' : $adreça) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Correu electrònic: </span><span class="valor-campo"><?php echo ($correuElectronic == '' ? 'Valor Buit' : $correuElectronic) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Contrasenya: </span><span class="valor-campo"><?php echo ($contrasenya == '' ? 'Valor Buit': $contrasenya) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Telèfon: </span><span class="valor-campo"><?php echo ($telefon == '' ? 'Valor Buit' : $telefon) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Donació: </span><span class="valor-campo"><?php echo ($donacio == '' ? 'Valor Buit' : $donacio) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Continent: </span><span class="valor-campo"><?php echo ($continent == '' ? 'Valor Buit' : $continent) ?></span></p>
        </div>
    </div>
</header>