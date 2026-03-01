<?php
    function registreApartat(string $apartat, string $ruta_fitxer): void {
        $apartat = strtoupper($apartat);
        $dia = date("d/m/Y");
        $hora = date("H:i:s");
        $directori_log = dirname($ruta_fitxer);
        if (!file_exists($directori_log)) {
            mkdir($directori_log, 0777, true);
        }
        $comptador = file_exists($ruta_fitxer) ? count(file($ruta_fitxer)) + 1 : 1;
        $registre = "$comptador :: Accés a l'apartat $apartat el dia $dia a l'hora $hora".PHP_EOL;
        if ($fitxer = fopen($ruta_fitxer, 'a')) {
            fwrite($fitxer, $registre);
            fclose($fitxer);
            if ($comptador % 10 == 0) {
                $directori_backup = "$directori_log/backup";
                if (!file_exists($directori_backup)) {
                    mkdir($directori_backup, 0777, true);
                }
                $ruta_backup = "$directori_backup/backup_".date("dmY_His").".log";
                copy($ruta_fitxer, $ruta_backup);
            }
        }
    }

    function registreAccionsUsuari(string $accio, string $usuari, string $fitxer): void {
        $accio = strtoupper($accio);
        $dia = date("d/m/Y");
        $hora = date("H:i:s");
        $directori_log = dirname($fitxer);
        if (!file_exists($directori_log)) {
            mkdir($directori_log, 0777, true);
        }
        $registre = "L'usuari $usuari ha realitzatl'acció $accio el dia $dia a l'hora $hora".PHP_EOL;
        if ($fitxer = fopen($fitxer, 'a')) {
            fwrite($fitxer, $registre);
            fclose($fitxer);
        }
    }