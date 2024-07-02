<?php

require_once './clases/auto.php';

$ruta_archivo = './archivos/autos.json';

$aAuto= Auto::traerJson($ruta_archivo);

Auto::MostrarAuto($aAuto);