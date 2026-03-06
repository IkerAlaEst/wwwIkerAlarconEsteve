<?php
    $ruta = './';
    if(strcmp(basename($_SERVER['PHP_SELF']),'index.php')!=0) {
        $ruta = '../';
    }

    $apartatActual = '';
    $paginaActual = basename($_SERVER['PHP_SELF']);
    if ($paginaActual === 'index.php') {
        $apartatActual = isset($_GET['apartat']) ? strtolower($_GET['apartat']) : '';
        if ($apartatActual === '') {
            $apartatActual = 'inici';
        }
    } elseif ($paginaActual === 'processaRegistre.php') {
        $apartatActual = 'registre';
    } elseif ($paginaActual === 'processaContacte.php') {
        $apartatActual = 'contacte';
    }
?>

<nav class="contenidor-principal">
    <div class="contenidor-secundari" id="menu">
        <?php if ($apartatActual === 'inici'): ?>
            <span class="menu-actiu">Inici</span>
        <?php else: ?>
            <a href="<?php echo $ruta?>index.php?apartat=inici">Inici</a>
        <?php endif; ?>
        <?php if (!isset($_SESSION['correuLogin'])): ?>
            <?php if ($apartatActual === 'registre'): ?>
                <span class="menu-actiu">Registre</span>
            <?php else: ?>
                <a href="<?php echo $ruta?>index.php?apartat=registre">Registre</a>
            <?php endif; ?>
        <?php endif; ?>
        <?php if ($apartatActual === 'contacte'): ?>
            <span class="menu-actiu">Contacte</span>
        <?php else: ?>
            <a href="<?php echo $ruta?>index.php?apartat=contacte">Contacte</a>
        <?php endif; ?>
        <?php if ($apartatActual === 'apadrina'): ?>
            <span class="menu-actiu">Apadrina</span>
        <?php else: ?>
            <a href="<?php echo $ruta?>index.php?apartat=apadrina">Apadrina</a>
        <?php endif; ?>
    </div>
</nav>