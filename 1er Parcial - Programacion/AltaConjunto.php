<?php

require_once './clases/tienda.php';
require_once './clases/venta.php';
require_once './clases/conjunto.php';

$nombreCamisa= $_POST['nombreCamisa'];
$nombrePantalon= $_POST['nombrePantalon'];
$tipoPantalon= $_POST['tipoPantalon'];
$tipoCamisa= $_POST['tipoCamisa'];


$nombre_archivo = $_FILES ['archivo']['name'];
$archivoTemp = $_FILES['archivo']['tmp_name'];
$carpeta_archivos = './ImagenesDeConjuntos/2024/';

$nombreJsonTienda = 'tienda.json';

$aTienda = Tienda::leerJson($nombreJsonTienda);

$Vtaconjunto = conjunto::altaConjuntoTienda($nombreCamisa ,$nombrePantalon , $tipoCamisa , $tipoPantalon , $aTienda );

Tienda::guardarJSON($Vtaconjunto , $nombreJsonTienda);

conjunto::crearImagen($carpeta_archivos,$Vtaconjunto,$archivoTemp,$nombre_archivo);




