<?php

require_once './clases/tienda.php';
require_once './clases/venta.php';
require_once './clases/conjunto.php';

$nombreCamisa= $_POST['nombreCamisa'];
$nombrePantalon= $_POST['nombrePantalon'];
$tipoPantalon= $_POST['tipoPantalon'];
$tipoCamisa= $_POST['tipoCamisa'];
$stockCamisa = $_POST['stockCamisa'];
$stockPantalon = $_POST['stockPantalon'];

$nombreJsonVenta = 'venta.json';
$nombreJsonTienda = 'tienda.json';

$aTienda = Tienda::leerJson($nombreJsonTienda);

$aVentas = Venta::leerJson($nombreJsonVenta);

$Vtaconjunto = conjunto::altaConjuntoVenta($nombreCamisa ,$nombrePantalon , $tipoCamisa , $tipoPantalon ,$stockCamisa,$stockPantalon, $aTienda , $aVentas ,$nombreJsonTienda);

Tienda::guardarJSON($Vtaconjunto , $nombreJsonVenta);




