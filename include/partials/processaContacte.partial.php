<?php
    $buit = '<span class="vacio">*Valor Buit*</span>';
    $correuElectronic = '';
    if (isset($_POST['correuElectronic'])) $correuElectronic = trim(htmlspecialchars($_POST['correuElectronic']));
    $assumpte = '';
    if (isset($_POST['assumpte'])) $assumpte = trim(htmlspecialchars($_POST['assumpte']));
    $missatge = '';
    if (isset($_POST['missatge'])) $missatge = trim(htmlspecialchars($_POST['missatge']));
    $missatgeSeparat = explode(' ', $missatge)
?>

<main class="contenidor-principal">
    <div class="contenidor-secundari">
        <div class="contenidor-titol">
            <h2>Contacte</h2>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Correu electrònic: </span><span class="valor-campo"><?php echo ($correuElectronic == '' ? $buit : $correuElectronic) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Assumpte: </span><span class="valor-campo"><?php echo ($assumpte == '' ? $buit : $assumpte) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p class="nombre-campo">
                Missatge:
            </p>
                <ul style="list-style-type: none; display:inline-block;" class="valor-campo">
                <?php 
                    if ($missatge === '') {
                        echo "<li>$buit</li>";
                    } else {
                        foreach ($missatgeSeparat as $valor) {
                            $paraula = trim($valor); 
                            if ($paraula !== '') {
                                $classe = '';
                                $lower = strtolower($paraula);
                                if ($lower === 'apadrinar' || $lower === 'animal') {
                                    $classe = ' paraula-missatge-especial';
                                } else if (strlen($paraula) >= 10) {
                                    $classe = ' paraula-missatge-llarga';
                                }
                                echo '<li class="paraula-missatge'.$classe.'">'.$paraula.'</li>';
                            }
                        }
                    }
                ?>
            </ul>
        </div>
    </div>
</main>