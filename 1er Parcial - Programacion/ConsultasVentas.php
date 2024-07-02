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




Venta::consultaFecha($fechaRecibida , $aVenta);
Venta::consultaUsuario($mail,$aVenta);
Venta::consultaPorTipo($tipo,$aVenta);
Tienda::consultaEntrePrecios($precioHasta,$precioDesde,$aTienda);

