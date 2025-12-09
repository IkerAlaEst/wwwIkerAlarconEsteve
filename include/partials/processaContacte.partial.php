<?php
    $buit = '<span class="vacio">*Valor Buit*</span>';
    $correuElectronic = '';
    if (isset($_POST['correuElectronic'])) $correuElectronic = trim(htmlspecialchars($_POST['correuElectronic']));
    $assumpte = '';
    if (isset($_POST['assumpte'])) $assumpte = trim(htmlspecialchars($_POST['assumpte']));
    $missatge = '';
    if (isset($_POST['missatge'])) $missatge = trim(htmlspecialchars($_POST['missatge']));
    $missatgeExplotat = explode(' ', $missatge);
    $missatgeSeparat = array();
    for ($i=0, $j=0; $i < count($missatgeExplotat); $i++) { 
        if (trim($missatgeExplotat[$i] !== '')) {
            $missatgeSeparat[$j] = trim($missatgeExplotat[$i]);
            $j++;
        }
    }
    $llongitud = 0;
    if (count($missatgeSeparat) > 0) {
        $llongitud = count($missatgeSeparat);
    }
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
        <div class="processa-vertical">
            <div class="contenidor-processa">
                <p class="nombre-campo">
                    Missatge:
                </p>
                <table class="valor-campo processa-missatge-table">
                    <?php 
                        if ($missatge === '') {
                            echo '<tr><td class="processa-missatge-table-data background-color-3">'.$buit.'</td></tr>';
                        } else {
                            $columnes = ceil(sqrt($llongitud));
                            $files = $columnes;
                            if ($columnes > 6) {
                                $columnes = 6;
                                $files = ceil($llongitud/6);
                            }
                            $posicio = 0;
                            for ($i = 0; $i < $files; $i++) {
                                echo '<tr>';
                                for ($j=0; $j < $columnes; $j++, $posicio++) {
                                    echo '<td class="processa-missatge-table-data background-color-'.random_int(1, 5).'">';
                                    if ($posicio < $llongitud) {
                                        $paraula = $missatgeSeparat[$posicio];
                                        $classe = '';
                                        $lower = strtolower($paraula);
                                        if ($lower === 'apadrinar' || $lower === 'animal') {
                                            $classe = ' paraula-missatge-especial';
                                        } else if (strlen($paraula) >= 10) {
                                            $classe = ' paraula-missatge-llarga';
                                        }
                                        echo '<span class="paraula-missatge'.$classe.'">'.$paraula.'</span>';
                                    }
                                    echo '</td>';
                                }
                                echo '</tr>';
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</main>