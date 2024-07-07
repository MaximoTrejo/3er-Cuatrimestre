<?php

require_once './clases/venta.php';
require_once './clases/tienda.php';

$fechaRecibida = DateTime::createFromFormat('y-m-d', $_GET['fechaParticular']) ? new DateTime($_GET['fechaParticular']) : new DateTime('yesterday');;
$tipo = $_GET['tipo'];
$precioDesde = $_GET['precioDesde'];
$precioHasta = $_GET['precioHasta'];
$mail = $_GET['mail'];


$aVenta = Venta::leerJson("venta.json");
$aTienda = Tienda::leerJson("tienda.json");



//a
echo "a"."\n";
Venta::consultaFecha($fechaRecibida , $aVenta);
//b
echo "b"."\n";
Venta::consultaUsuario($mail,$aVenta);
//c
echo "c"."\n";
Venta::consultaPorTipo($tipo,$aVenta);
//e
echo "e"."\n";
Tienda::consultaEntrePrecios($precioHasta,$precioDesde,$aTienda);
//f
echo "f"."\n";
Venta::productoMasVendido($aVenta);
