<header class="contenidor-principal">
    <div class="contenidor-roig">
        <h1>Apadrina un animal en perill d'extinció</h1>
    </div>
    <div class="contenidor-blau">
        <h3>
            <?php
                $setmana = array('Dilluns', 'Dimarts', 'Dimecres', 'Ditjous', 'Divendres', 'Dissabte', 'Diumenge');
                $mes = array('Gener', 'Febrer', 'Març', 'Abril', 'Maig', 'Juny', 'Juliol', 'Agost', 'Septembre', 'Octubre', 'Novembre', 'Desembre');
                echo $setmana[date('N') - 1].', '.date('j').' de '.$mes[date('m') - 1].' de '.date('Y');
            ?>
        </h3>
    </div>
</header>