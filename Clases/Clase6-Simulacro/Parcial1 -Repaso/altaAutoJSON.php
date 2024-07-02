<?php

require_once './clases/auto.php';

$patente = $_POST['patente'];
$marca = $_POST['marca'];
$color= $_POST['color'];
$precio = $_POST['precio'];


$ruta_archivo = './archivos/autos.json';

//Auto::traerJson($ruta_archivo);

if(Auto::guardarJSON($ruta_archivo,$patente,$marca,$color,$precio)){
    echo "Se guardo el archivo";
}else{
    echo "Me rompi";
}

