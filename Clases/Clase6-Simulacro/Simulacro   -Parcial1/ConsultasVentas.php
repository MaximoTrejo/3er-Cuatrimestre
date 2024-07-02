<?php

require_once './Clases/venta.php';

$fechaRecibida = DateTime::createFromFormat('y-m-d', $_GET['fechaParticular']) ? new DateTime($_GET['fechaParticular']) : new DateTime('yesterday');;
$usuario = $_GET['mail'];
$fechaDesde = $_GET['fechaDesde'];
$fechaHasta = $_GET['fechaHasta'];
$sabor  = $_GET['saborH'];



$aVenta = Venta::leerJson("venta.json");

Venta::consultaFecha($fechaRecibida , $aVenta);
Venta::consultaUsuario($usuario,$aVenta);
Venta::consultaEntreFechas($fechaHasta,$fechaDesde,$aVenta);
Venta::consultaPorSabores($sabor,$aVenta);






