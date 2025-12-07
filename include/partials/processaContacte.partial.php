<?php
    $correuElectronic = '';
    if (isset($_POST['correuElectronic'])) $correuElectronic = trim(htmlspecialchars($_POST['correuElectronic']));
    $assumpte = '';
    if (isset($_POST['assumpte'])) $assumpte = trim(htmlspecialchars($_POST['assumpte']));
    $missatge = '';
    if (isset($_POST['missatge'])) $missatge = trim(htmlspecialchars($_POST['missatge']));
?>

<header class="contenidor-principal">
    <div class="contenidor-secundari">
        <div class="contenidor-titol">
            <h2>Contacte</h2>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Correu electrònic: </span><span class="valor-campo"><?php echo ($correuElectronic == '' ? 'Valor Buit' : $correuElectronic) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Assumpte: </span><span class="valor-campo"><?php echo ($assumpte == '' ? 'Valor Buit': $assumpte) ?></span></p>
        </div>
        <div class="contenidor-processa">
            <p><span class="nombre-campo">Missatge: </span><span class="valor-campo"><?php echo ($missatge == '' ? 'Valor Buit' : $missatge) ?></span></p>
        </div>
    </div>
</header>