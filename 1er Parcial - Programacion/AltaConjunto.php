<?php

require_once './clases/tienda.php';
require_once './clases/venta.php';
require_once './clases/ventaConjunto.php';

$nombreCamisa= $_POST['nombreCamisa'];
$nombrePantalon= $_POST['nombrePantalon'];
$tipoPantalon= $_POST['tipoPantalon'];
$tipoCamisa= $_POST['tipoCamisa'];


$nombre_archivo = $_FILES ['archivo']['name'];
$archivoTemp = $_FILES['archivo']['tmp_name'];
$carpeta_archivos = './ImagenesDeConjuntos/2024/';

$nombreJsonVenta = 'venta.json';
$nombreJsonTienda = 'tienda.json';

$aTienda = Tienda::leerJson($nombreJsonTienda);

$aVentas = Venta::leerJson($nombreJsonVenta);

$Vtaconjunto = VentaConjunto::altaConjunto($nombreCamisa ,$nombrePantalon , $tipoCamisa , $tipoPantalon , $aTienda , $aVentas );

Tienda::guardarJSON($Vtaconjunto , $nombreJsonVenta);

VentaConjunto::crearImagen($carpeta_archivos,$Vtaconjunto,$archivoTemp,$nombre_archivo);




