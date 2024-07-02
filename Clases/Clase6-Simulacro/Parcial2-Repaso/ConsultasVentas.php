<?php

require_once './clases/pizza.php';
require_once './clases/venta.php';
//$fechaRecibida = DateTime::createFromFormat('y-m-d', $_GET['fechaParticular']) ? new DateTime($_GET['fechaParticular']) : new DateTime('yesterday');;
$usuario = $_GET['mail'];
$fechaDesde = $_GET['fechaDesde'];
$fechaHasta = $_GET['fechaHasta'];
$sabor  = $_GET['sabor'];

$nombreJsonVenta = 'Venta.json';

$aVenta = Venta::leerJson($nombreJsonVenta);

Venta::consultaCantidad($aVenta);
Venta::consultaEntreFechas($fechaHasta,$fechaDesde,$aVenta);
Venta::consultaUsuario($usuario,$aVenta);
Venta::consultaPorSabores($sabor,$aVenta);


