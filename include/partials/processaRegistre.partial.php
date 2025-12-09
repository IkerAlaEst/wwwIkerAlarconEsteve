<?php
    $buit = '<span class="vacio">*Valor Buit*</span>';
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
    $animal = 'avatarAnimalDefault';
    if (isset($_POST['animal']) && strcmp($_POST['animal'],'') != 0) $animal = trim(htmlspecialchars($_POST['animal']));
    $imatgeAnimal = '../img/avatarAnimalDefault.png';
    switch ($animal) {
        case 'goril·la':
            $imatgeAnimal = '../img/gorilla.jpg';
            break;
        case 'tortuga':
            $imatgeAnimal = '../img/tortuga.jpg';
            break;
        case 'tigre':
            $imatgeAnimal = '../img/tigre.jpg';
            break;
        case 'rinoceront':
            $imatgeAnimal = '../img/rinoceront.jpg';
            break;
        case 'orangutan':
            $imatgeAnimal = '../img/orangutan.jpg';
            break;
    }
    $continent = '';
    if (isset($_POST['continent'])) $continent = trim(htmlspecialchars($_POST['continent']));
    $puntuacio = 1;
    if (isset($_POST['puntuacio'])) $puntuacio = $_POST['puntuacio'];
    $estrella = '';
    switch ($puntuacio) {
        case 1:
            $estrella = '../img/estrella-roja.png';
            break;
        case 2:
            $estrella = '../img/estrella-naranja.png';
            break;
        case 3:
            $estrella = '../img/estrella-amarilla.png';
            break;
        case 4:
            $estrella = '../img/estrella-verde.png';
            break;
        case 5:
            $estrella = '../img/estrella-brillante.webp';
            break;
    }
    $multiplicador = 1;
    if (isset($_POST['multiplicador'])) $multiplicador = $_POST['multiplicador'];
    $dadesAnimals = array ('goril·la' => array('Nom' => 'Peter', 'Menjar favorit' => 'Plàtans', 'Any de neixement' => '2005'), 'tortuga' => array('Nom' => 'Guantes', 'Menjar favorit' => 'Alga seca', 'Any de neixement' => '2010'), 'tigre' => array('Nom' => 'Chester', 'Menjar favorit' => 'Ternera', 'Any de neixement' => '2017'), 'rinoceront' => array('Nom' => 'Saul', 'Menjar favorit' => 'Arroç amb bogavant', 'Any de neixement' => '2005'), 'orangutan' => array('Nom' => 'César', 'Menjar favorit' => 'Mà de buda', 'Any de neixement' => '2007'))
?>

<main class="contenidor-principal">
    <div class="contenidor-secundari">
        <div class="contenidor-titol">
            <h2>Registre</h2>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Nom: </span><span class="valor-campo"><?php echo ($nom == '' ? $buit : $nom) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Cognoms: </span><span class="valor-campo"><?php echo ($cognoms == '' ? $buit : $cognoms) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Adreça: </span><span class="valor-campo"><?php echo ($adreça == '' ? $buit : $adreça) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Correu electrònic: </span><span class="valor-campo"><?php echo ($correuElectronic == '' ? $buit : $correuElectronic) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Contrasenya: </span><span class="valor-campo"><?php echo ($contrasenya == '' ? $buit : $contrasenya) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Telèfon: </span><span class="valor-campo"><?php echo ($telefon == '' ? $buit : $telefon) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Donació: </span><span class="valor-campo"><?php echo ($donacio == '' ? $buit : $donacio) ?></span></p>
        </div>
        <div class="processa-vertical">
            <div class="contenidor-processa">
                <p>
                    <span class="nombre-campo">Animal a apadrinar: </span>
                </p>
                <div class="valor-campo" style="text-align: center;">
                    <img style="max-width: 100%;"src="<?php echo $imatgeAnimal?>" alt="<?php echo $animal?>">
                    <?php
                        if (strcmp($animal, "avatarAnimalDefault") != 0) {
                            echo "<table class=\"taula-dades\">";
                            echo "<tr><th colspan=\"2\" class=\"encapçalament-taula-dades\">Dades de l'animal<th></tr>";
                            foreach ($dadesAnimals[$animal] as $index => $valor) {
                                echo "<tr>";
                                echo "<td class=\"index-taula-dades\">$index</td>";
                                echo "<td class=\"valor-taula-dades\">$valor</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Continent: </span><span class="valor-campo"><?php echo ($continent == '' ? $buit : $continent) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p class="nombre-campo">
                <span class="nombre-campo">Puntuació: </span>
            </p>
            <span class="valor-campo">
                <p>
                    <span class="valor-campo-puntuacion">
                        <?php echo "$puntuacio * $multiplicador"?>
                    </span>
                </p>
                <?php
                    for ($i=0; $i < $puntuacio * $multiplicador; $i++) { 
                        echo "<img style=\"height: 2rem;\" src=\"$estrella\" alt=\"estrella\">";
                    }
                ?>
            </span>
        </div>
        <div class="processa-vertical">
            <div class="contenidor-processa">
                <p>
                    <span class="nombre-campo">Animals del mes:</span>
                </p>
                <div class="contenidor-processa-imatges">
                    <?php 
                        $animals;
                        if(isset($_POST['animals'])) {
                            $animals = $_POST['animals'];
                            for ($i = 0; $i < count($animals); $i++) {
                                echo '<img <img width="50%" src="../img/'.$animals[$i].'.jpg" alt="'.$animals[$i].'">';
                            }
                        } else {
                            echo '<img style="max-width: 100%" style="display: block;" src="../img/avatarAnimalDefault.png" alt="avatarAnimalDefault">';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>