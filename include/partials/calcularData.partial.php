<?php
$setmana = array('Dilluns', 'Dimarts', 'Dimecres', 'Ditjous', 'Divendres', 'Dissabte', 'Diumenge');
$mes = array('Gener', 'Febrer', 'Març', 'Abril', 'Maig', 'Juny', 'Juliol', 'Agost', 'Septembre', 'Octubre', 'Novembre', 'Desembre');
$data = $setmana[date('N') - 1].', '.date('j').' de '.$mes[date('m') - 1].' de '.date('Y');
