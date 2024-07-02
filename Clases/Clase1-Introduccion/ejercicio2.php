<?php

/*
Aplicación No 2 (Mostrar fecha y estación)
Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
año es. Utilizar una estructura selectiva múltiple.
*/

$fecha =date("d-m-y");
$estacion = date("M");
 
echo "Fecha ".$fecha;
echo "<br/>";

switch ($estacion) {
    case "May":
        echo"Otoño";
        echo "<br/>";

        break;
    }



?>