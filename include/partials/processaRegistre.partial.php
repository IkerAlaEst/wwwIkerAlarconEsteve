<main class="contenidor-principal">
    <div class="contenidor-secundari">
        <?php
            if ($nom !== "" && $contrasenya !== "") {
                ?>
                    <div class="contenidor-titol">
                        <h2>
                            <?php
                                switch (insereixUsuari($nom, $cognoms, $correuElectronic, $contrasenya)) {
                                    case 'usuariInserit':
                                        echo "Usuari $correuElectronic inserit correctament en la base de dades";
                                        break;
                                    case 'usuariExisteix':
                                        echo "Error: Usuari $correuElectronic no s'ha pogut inserir correctament en la base de dades";
                                        break;
                                    default:
                                        echo "Error: Usuari $correuElectronic ja existeix en la base de dades";
                                        break;
                                }
                            ?>
                        </h2>
                    </div>
                <?php
            }
        ?>
        <div class="contenidor-titol">
            <h2>Registre</h2>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Nom: </span><span class="valor-campo"><?php echo ($nom == '' ? BUIT : $nom) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Cognoms: </span><span class="valor-campo"><?php echo ($cognoms == '' ? BUIT : $cognoms) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Adreça: </span><span class="valor-campo"><?php echo ($adreça == '' ? BUIT : $adreça) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Correu electrònic: </span><span class="valor-campo"><?php echo ($correuElectronic == '' ? BUIT : $correuElectronic) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Contrasenya: </span><span class="valor-campo"><?php echo ($contrasenya == '' ? BUIT : $contrasenya) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Telèfon: </span><span class="valor-campo"><?php echo ($telefon == '' ? BUIT : $telefon) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Donació: </span><span class="valor-campo"><?php echo ($donacio == '' ? BUIT : $donacio) ?></span></p>
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
            <p><span class="nombre-campo">Continent: </span><span class="valor-campo"><?php echo ($continent == '' ? BUIT : $continent) ?></span></p>
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
                        if(isset($_POST['animals']) || isset($_SESSION['animalsRegistre'])) {
                            $animals;
                            if (isset($_SESSION["animalsRegistre"])) {
                                $animals = unserialize($_SESSION["animalsRegistre"]);
                            }
                            if (isset($_POST["animals"])) {
                                $animals = $_POST['animals'];
                                $_SESSION["animalsRegistre"] = serialize($animals);
                            }
                            for ($i = 0; $i < count($animals); $i++) {
                                echo '<img width="50%" src="../img/'.$animals[$i].'.jpg" alt="'.$animals[$i].'">';
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