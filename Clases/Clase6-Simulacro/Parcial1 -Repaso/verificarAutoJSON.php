<?php

require_once './clases/auto.php';

$patente = $_POST['patente'];

$ruta_archivo = './archivos/autos.json';

if(Auto::verificarAutoJSON($patente,$ruta_archivo)){
    echo "existe";
}else{
    echo "no existe";
}


